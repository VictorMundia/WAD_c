class user:
    def __init__(self,username,email,location):
        self.username=username
        self.email=email
        self.location=location


    def viewupcomingevents(self,events):
        self.events=events

        # View all upcoming events
        print(f"Upcoming events near {self.location}:")

        for event in events:
            if event.location == self.location:
                print(f"Event: {event.name}, Date: {event.date}, Tickets Available: {event.available_tickets}")
                      

    def purchase_tickets(self,events):
            if event.available_tickets > 0:
                      print(f"{self.username} has purchased a ticket for {event.event_name}")        
                      event.update_tickets(-1):

                      else:
                      print(f"Sorry {event.event_name} has been sold out!"):

                                        
        
                      
