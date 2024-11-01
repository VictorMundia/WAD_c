class Ticket:
    def __init__ (self,ticket_id,event,buyer):
        self.ticket_id=ticket_id
        self.event=event
        self.buyer=buyer

    def veiw_ticket(self):
        return f"Ticket ID: {self.ticket_id}, Event: {self.event.event_name}, Buyer: {self.buyer.username}"
