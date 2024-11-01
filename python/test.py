# user.py
class User:
    """
    Base User class representing a regular user in the ticketing system.
    Handles basic user information and ticket purchasing functionality.
    """
    def __init__(self, username, email, location, password):
        # Initialize basic user information
        self.username = username
        self.email = email
        self.location = location
        self.password = password 
        self.payment_info = None  # Store payment information once added
    
    def view_upcoming_events(self, events):
        """
        Display all available events and return them as a list.
        Args:
            events (list): List of Event objects
        Returns:
            list: List of available events
        """
        available_events = []
        print(f"\nUpcoming events near {self.location}:")
        for i, event in enumerate(events, 1):  # Start counting from 1
            print(f"{i}. {event.get_event_details()}")
            available_events.append(event)
        return available_events
    
    def purchase_tickets(self, event):
        """
        Process ticket purchase for regular users at full price.
        Args:
            event (Event): Event object to purchase tickets for
        Returns:
            bool: True if purchase successful, False otherwise
        """
        if event.available_tickets > 0:
            print(f"{self.username} has purchased a ticket for {event.name} at ${event.ticket_price}")
            event.update_tickets(-1)
            return True
        else:
            print(f"Sorry, {event.name} has been sold out!")
            return False
    
    def add_payment_method(self, card_number, expiry, cvv):
        """
        Store user's payment information.
        Args:
            card_number (str): Credit card number
            expiry (str): Card expiry date
            cvv (str): Card CVV
        Returns:
            bool: True if payment method added successfully
        """
        self.payment_info = {
            "card_number": card_number,
            "expiry": expiry,
            "cvv": cvv
        }
        return True

class PremiumUser(User):
    """
    Premium User class that inherits from base User class.
    Includes additional benefits like ticket discounts.
    """
    def __init__(self, username, email, location, password):
        super().__init__(username, email, location, password)
    
    def purchase_tickets(self, event):
        """
        Process ticket purchase for premium users with 10% discount.
        Args:
            event (Event): Event object to purchase tickets for
        Returns:
            bool: True if purchase successful, False otherwise
        """
        if event.available_tickets > 0:
            discount = 0.1 * event.ticket_price  # 10% discount
            final_price = event.ticket_price - discount
            print(f"{self.username} has purchased a discounted ticket for {event.name} at ${final_price:.2f}")
            event.update_tickets(-1)
            return True
        else:
            print(f"Sorry, {event.name} has been sold out!")
            return False

# event.py
class Event:
    """
    Event class representing a ticketed event in the system.
    Handles event details and ticket availability.
    """
    def __init__(self, name, date, location, available_tickets, ticket_price):
        self.name = name
        self.date = date
        self.location = location
        self.available_tickets = available_tickets
        self.ticket_price = ticket_price
    
    def update_tickets(self, number):
        """
        Update the number of available tickets.
        Args:
            number (int): Number to add (positive) or subtract (negative)
        Returns:
            int: Updated number of available tickets
        """
        self.available_tickets += number
        return self.available_tickets
    
    def get_event_details(self):
        """
        Get formatted string of event details.
        Returns:
            str: Formatted event details
        """
        return (f"Event: {self.name}, Date: {self.date}, Location: {self.location}, "
                f"Tickets Available: {self.available_tickets}, Price: ${self.ticket_price}")

# ticket.py
class Ticket:
    """
    Ticket class representing a purchased ticket.
    Links an event with a user and includes unique identifier.
    """
    def __init__(self, ticket_id, event, user):
        self.ticket_id = ticket_id
        self.event = event
        self.user = user
    
    def view_ticket(self):
        """
        Get formatted string of ticket details.
        Returns:
            str: Formatted ticket information
        """
        return (f"Ticket ID: {self.ticket_id}, Event: {self.event.name}, "
                f"User: {self.user.username}, Location: {self.event.location}, "
                f"Date: {self.event.date}")

# ticketing_system.py
class TicketingSystem:
    """
    Main ticketing system class that manages users, events, and tickets.
    Handles all system operations including registration, login, and purchases.
    """
    def __init__(self):
        # Initialize system data structures
        self.users = {}  # Dictionary to store users: {username: User object}
        self.events = []  # List to store events
        self.tickets = []  # List to store all tickets
        self.next_ticket_id = 1  # Counter for generating unique ticket IDs
        
        # Initialize sample events
        self.events = [
            Event("Rock Concert", "2024-11-20", "New York", 100, 50),
            Event("Tech Conference", "2024-12-05", "San Francisco", 50, 100),
            Event("Comedy Show", "2024-11-25", "Los Angeles", 75, 40),
            Event("Art Exhibition", "2024-12-10", "Chicago", 200, 25)
        ]
    
    def register_user(self):
        """
        Handle new user registration process.
        Returns:
            User: Newly created user object
        """
        print("\n=== User Registration ===")
        while True:
            username = input("Enter username: ").strip()
            if username in self.users:
                print("Username already exists. Please choose another.")
                continue
            
            # Collect user information
            email = input("Enter email: ").strip()
            location = input("Enter location (city): ").strip()
            password = input("Enter password: ").strip()
            
            # Determine account type
            account_type = input("Would you like a Premium account? (yes/no): ").strip().lower()
            
            # Create appropriate user type
            if account_type == 'yes':
                user = PremiumUser(username, email, location, password)
                print("Premium account created!")
            else:
                user = User(username, email, location, password)
                print("Regular account created!")
            
            self.users[username] = user
            return user
    
    def login_user(self):
        """
        Handle user login process.
        Returns:
            User: Logged in user object
        """
        print("\n=== User Login ===")
        while True:
            username = input("Enter username (or 'register' for new account): ").strip()
            
            # Handle new user registration
            if username.lower() == 'register':
                return self.register_user()
            
            # Verify existing user
            if username not in self.users:
                print("Username not found. Please try again or type 'register'")
                continue
            
            # Verify password
            password = input("Enter password: ").strip()
            user = self.users[username]
            
            if user.password == password:  # In production, use proper password verification
                print(f"Welcome back, {username}!")
                return user
            else:
                print("Incorrect password. Please try again.")
    
    def process_payment(self, user, event):
        """
        Handle payment processing for ticket purchase.
        Args:
            user (User): User making the purchase
            event (Event): Event being purchased
        Returns:
            bool: True if payment successful
        """
        # Collect payment information if not already stored
        if not user.payment_info:
            print("\n=== Payment Information ===")
            card_number = input("Enter card number: ").strip()
            expiry = input("Enter card expiry (MM/YY): ").strip()
            cvv = input("Enter CVV: ").strip()
            
            if user.add_payment_method(card_number, expiry, cvv):
                print("Payment information saved successfully!")
        
        # Simulate payment processing
        print("\nProcessing payment...")
        print("Payment successful!")
        return True
    
    def generate_ticket(self, event, user):
        """
        Generate a new ticket for a successful purchase.
        Args:
            event (Event): Event the ticket is for
            user (User): User who purchased the ticket
        Returns:
            Ticket: New ticket object
        """
        ticket_id = f"T{self.next_ticket_id:03d}"  # Format: T001, T002, etc.
        self.next_ticket_id += 1
        ticket = Ticket(ticket_id, event, user)
        self.tickets.append(ticket)
        return ticket
    
    def run(self):
        """
        Main system loop that handles user interaction.
        """
        print("Welcome to the Event Ticketing System!")
        
        while True:
            # Handle user authentication
            user = self.login_user()
            
            while True:
                # Display main menu
                print("\n=== Main Menu ===")
                print("1. View Events")
                print("2. Purchase Tickets")
                print("3. View My Tickets")
                print("4. Logout")
                print("5. Exit")
                
                choice = input("Enter your choice (1-5): ").strip()
                
                # Handle user choices
                if choice == '1':
                    user.view_upcoming_events(self.events)
                
                elif choice == '2':
                    # Show events and handle purchase
                    available_events = user.view_upcoming_events(self.events)
                    event_choice = input("\nEnter the number of the event you want to purchase (0 to cancel): ").strip()
                    
                    if event_choice.isdigit() and 0 < int(event_choice) <= len(available_events):
                        selected_event = available_events[int(event_choice) - 1]
                        
                        # Process payment and generate ticket
                        if self.process_payment(user, selected_event):
                            if user.purchase_tickets(selected_event):
                                ticket = self.generate_ticket(selected_event, user)
                                print("\nTicket purchased successfully!")
                                print(ticket.view_ticket())
                
                elif choice == '3':
                    # Show user's tickets
                    user_tickets = [ticket for ticket in self.tickets if ticket.user == user]
                    if user_tickets:
                        print("\n=== Your Tickets ===")
                        for ticket in user_tickets:
                            print(ticket.view_ticket())
                    else:
                        print("\nYou haven't purchased any tickets yet.")
                
                elif choice == '4':
                    # Logout
                    print(f"Goodbye, {user.username}!")
                    break
                
                elif choice == '5':
                    # Exit system
                    print("Thank you for using the Event Ticketing System!")
                    return
                
                else:
                    print("Invalid choice. Please try again.")

# main.py
if __name__ == "__main__":
    # Create and run the ticketing system
    system = TicketingSystem()
    system.run()