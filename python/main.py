from Event import Event
from User import User
from PremiumUser import PremiumUser
from Ticket import Ticket

# Creating events
event1 = Event("Concert", "New York", 100, 50, "2024-11-20")
event2 = Event("Tech Conference", "San Francisco", 100, 100, "2024-12-05")
Events = [event1, event2]

# Creating users
user1 = User("Victor", "victor@example.com", "New York")
user2 = PremiumUser("Alice", "alice@example.com", "San Francisco")

# User viewing events
user1.view_upcoming_events(Events)

# User purchasing tickets
user1.purchase_tickets(event1)
user2.purchase_tickets(event2)

# Creating a ticket
ticket1 = Ticket("T001", event1, user1)
print(ticket1.view_ticket())
