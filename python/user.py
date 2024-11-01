from Event import Event

class User:
    def __init__(self,username,email,location):
        self.username=username
        self.email=email
        self.location=location


def view_upcoming_events(self, Events):
    self.Events = Events
    
    print(f"Upcoming events near {self.location}:")
    
    for Event in Events:
        if Event.location == self.location:
            print(f"Event: {Event.event_name}, Date: {Event.date}, Tickets Available: {Event.available_tickets}")  # Note: using event_name instead of name
                      

    def purchase_tickets(self,Events):
            if Event.available_tickets > 0:
                      print(f"{self.username} has purchased a ticket for {Event.Event_name}")        
                      Event.update_tickets(-1)

            else:
                      print(f"Sorry {Event.Event_name} has been sold out!")




                                        
        
                      
