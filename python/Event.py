class Event:
    def __init__(self, event_name, location, available_tickets, ticket_price, date):
        self.event_name = event_name
        self.location = location
        self._available_tickets = available_tickets
        self.ticket_price = ticket_price
        self.date = date

    @property
    def available_tickets(self):
        return self._available_tickets

    def update_tickets(self, number):
        self._available_tickets += number

    def get_event_details(self):
        return f"Event: {self.event_name}, Date: {self.date}, Location: {self.location}, Tickets Available: {self.available_tickets}"

    
def get_event_details(self):
    #View the event details

    return f"Event: {self.event_name},Date: {self.date},Location {self.location},Tickets Available: {self.available_tickets}"






