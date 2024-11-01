<?php 
// Start the session
session_start();


// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


// Include configuration and helper files
require_once("connect.php");
require_once("register.php");

// Ensure $conn is initialized
if (!isset($conn)) {
    die('Database connection not established.');
}

// Check if user is logged in and get user data if available
$user = null;
if (isset($_SESSION['user_id'])) {
    $user = getUserById($conn, $_SESSION['user_id']);
}

// Function to get user by ID
function getUserById($conn, $userId) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Get featured and upcoming events




function getFeaturedEvents($conn, $limit) {

    $sql = "SELECT * FROM events WHERE is_featured = 1 LIMIT ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
      die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("i", $limit);

    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);

}

function getUpcomingEvents($conn, $limit) {
    $sql = "SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

$featuredEvents = getFeaturedEvents($conn, 6); // Get 6 featured events
$upcomingEvents = getUpcomingEvents($conn, 6); // Get 6 upcoming events

// Include the header
include("templates/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="EventHub - Your premier destination for discovering and booking exciting events">
    <meta name="keywords" content="events, tickets, concerts, tech events, nightlife, corporate meetings">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('assets/images/hero-bg.jpg') no-repeat center center;
            background-size: cover;
            padding: 150px 0;
            color: white;
            text-align: center;
        }

        .custom-card {
            transition: transform 0.3s ease;
            height: 100%;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .featured-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
        }

        .search-section {
            background: #f8f9fa;
            padding: 30px 0;
            margin-bottom: 40px;
        }
    </style>

    <title>EventHub - Discover Amazing Events</title>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="display-4 mb-4">Welcome to EventHub</h1>
        <p class="lead mb-4">Discover, Book, and Experience Amazing Events</p>
        <?php if (!$user): ?>
            <div class="cta-buttons">
                <a href="register.php" class="btn btn-primary btn-lg me-3">Sign Up Now</a>
                <a href="login.php" class="btn btn-outline-light btn-lg">Login</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Search Section -->
<section class="search-section">
    <div class="container">
        <form action="search.php" method="GET" class="row g-3 justify-content-center">
            <div class="col-md-4">
                <input type="text" class="form-control" name="keyword" placeholder="Search events...">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="category">
                    <option value="">All Categories</option>
                    <option value="tech">Tech Events</option>
                    <option value="concert">Concerts</option>
                    <option value="nightlife">Nightlife</option>
                    <option value="carmeet">Car Meets</option>
                    <option value="corporate">Corporate</option>
                    <option value="karaoke">Karaoke</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>
    </div>
</section>

<!-- Featured Events Carousel -->
<section class="mb-5">
    <div class="container">
        <div class="carousel-size">
            <div id="featuredCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach($featuredEvents as $index => $event): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <img src="<?php echo htmlspecialchars($event['image_url']); ?>" 
                                 class="d-block w-100" 
                                 alt="<?php echo htmlspecialchars($event['title']); ?>">
                            <div class="carousel-caption">
                                <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                                <p><?php echo htmlspecialchars($event['short_description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Event Categories -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Browse Events</h2>
        <div class="row">
            <?php
            $categories = [
                [
                    'title' => 'Tech Events',
                    'image' => 'assets/images/tech.jpg',
                    'description' => 'Unleash the Future: Dive into cutting-edge technology at our tech events! From AI breakthroughs to quantum computing, join us for inspiring talks, hands-on workshops, and networking with industry experts. 🚀',
                ],
                [
                    'title' => 'Concerts',
                    'image' => 'assets/images/concert.jpg',
                    'description' => 'Melodic Magic: Get ready to sway, sing, and dance! Our concert series features chart-topping artists, mind-blowing light shows, and an electric atmosphere. 🎵🎤',
                ],
                // Add other categories...
            ];

            foreach($categories as $category): ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-danger custom-card h-100">
                        <img src="<?php echo htmlspecialchars($category['image']); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($category['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($category['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($category['description']); ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="category.php?type=<?php echo strtolower(str_replace(' ', '-', $category['title'])); ?>" 
                               class="btn btn-success w-100">View Events</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Special Events Section -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Special Events</h2>
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <p class="lead">
                    Our Special Events section showcases a curated selection of unique and exciting events. 
                    From music festivals and art exhibitions to charity runs and networking events, 
                    we provide a diverse range of experiences to cater to all interests.
                </p>
            </div>
        </div>
        
        <!-- Featured Special Events -->
        <div class="row">
            <?php foreach($upcomingEvents as $event): ?>
                <div class="col-md-4 mb-4">
                    <div class="card custom-card h-100">
                        <?php if($event['is_featured']): ?>
                            <span class="featured-badge">Featured</span>
                        <?php endif; ?>
                        <img src="<?php echo htmlspecialchars($event['image_url']); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($event['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($event['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($event['description']); ?></p>
                            <p class="text-muted">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <?php echo date('F j, Y', strtotime($event['event_date'])); ?>
                            </p>
                            <p class="text-muted">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <?php echo htmlspecialchars($event['location']); ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="event.php?id=<?php echo $event['id']; ?>" class="btn btn-primary w-100">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h3>Stay Updated</h3>
                <p>Subscribe to our newsletter for the latest events and exclusive offers!</p>
                <form action="newsletter-signup.php" method="POST" class="row g-3 justify-content-center">
                    <div class="col-8">
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-light">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>

<?php include 'templates/footer.php'; ?>

</body>
</html>