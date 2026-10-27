Gezegen Backend — API Salgylary

1. Airports (Airaportlar)
• GET  http://192.168.1.11:8000/api/v1/airports
  (Ähli airaportlaryň sanawyny almak)

• GET  http://192.168.1.11:8000/api/v1/airports/1
  (ID boýunça bir airaport almak)

• DELETE  http://192.168.1.11:8000/api/v1/airports/1
  (Airaport pozmak)


2. Flights (Uçuşlar)
• GET  http://192.168.1.11:8000/api/v1/flights
  (Ähli uçuşlaryň sanawyny almak)

• GET  http://192.168.1.11:8000/api/v1/flights/1
  (ID boýunça bir uçuşy almak)


3. Tickets (Biletler)
• GET  http://192.168.1.11:8000/api/v1/tickets
  (Ähli biletleriň sanawyny almak)

• GET  http://192.168.1.11:8000/api/v1/tickets?full_name=...&phone=...
  (Müşderiniň ady we telefony boýunça bileti gözlemek)