from flask import Flask,request
import sys
from whatsfly import WhatsApp
app = Flask(__name__)

@app.route("/")
def hello_world():
    args = request.args
    print(args)
    phone = args.get("phone")
    message = args.get("message")
    chat = WhatsApp()
    chat.send_message(phone=phone, message=message)
    # return as json success
    return " "



# #!/usr/bin/env python3





# chat = WhatsApp()
# chat.send_message(phone="+9647518775861", message="hello")
# # chat.send_message(phone=sys.argv[1], message=sys.argv[2])

# # close the script
