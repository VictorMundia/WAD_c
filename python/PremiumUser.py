from User import User 
from Event import Event
class PremiumUser(User):
    def purchase_ticket(self,Event):
        #Buy ticket with a discount

        discount = 0.1 * Event.ticket_price #10% discount
        final_price= Event.ticket_price-discount

        if Event.available_tickets>0:
             print(f"{self.username} has purchased a discounted ticket for {Event.Event_name} at {final_price}")
             Event.update_tickets(-1)
        
        else:
             print(f"Sorry {Event.Event_name} has been sold out!")






    