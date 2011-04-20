#!/usr/bin/env python

def main():
    import ConfigParser
    config = ConfigParser.RawConfigParser()
    config.read('settings.cfg')
    me = config.get('MAIL','mail')
    subj = config.get('MAIL','subject')
    smtp_addr = config.get('MAIL','smtp_addr')
    smtp_port = config.getint('MAIL','smtp_port')
    smtp_username = config.get('MAIL','smtp_username')
    smtp_password = config.get('MAIL','smtp_password')
    
    text = ""
    html = ""
    with open('template.txt') as txtFile:
        text = txtFile.read()
    with open('template.html') as txtFile:
        html = txtFile.read()

    import csv
    import datetime
    now = datetime.datetime.now()
    reader = csv.reader(open('users.csv', 'rb'))
    for row in reader:
        if(now.month == int(row[3]) and now.day == int(row[2])):
            sendMail(me, row[1], subj, text, html, smtp_addr, smtp_port, smtp_username, smtp_password, dict(name=row[0]))

def sendMail(me, you, subject, txtTemplate, htmlTemplate, smtp_addr, smtp_port, smtp_username, smtp_password, params):
    import smtplib

    from email.mime.multipart import MIMEMultipart
    from email.mime.text import MIMEText

    # Create message container - the correct MIME type is multipart/alternative.
    msg = MIMEMultipart('alternative')
    msg['Subject'] = subject
    msg['From'] = me
    msg['To'] = you

    from string import Template
    # Create the body of the message (a plain-text and an HTML version).

    txt_template = Template(txtTemplate)
    text = txt_template.substitute(params)
    html_template = Template(htmlTemplate)
    html = html_template.substitute(params)

    # Record the MIME types of both parts - text/plain and text/html.
    part1 = MIMEText(text, 'plain')
    part2 = MIMEText(html, 'html')

    # Attach parts into message container.
    # According to RFC 2046, the last part of a multipart message, in this case
    # the HTML message, is best and preferred.
    msg.attach(part1)
    msg.attach(part2)

    # Send the message via local SMTP server.
    s = smtplib.SMTP(smtp_addr, smtp_port)
    if(smtp_username):
        s.login(smtp_username, smtp_password)
    # sendmail function takes 3 arguments: sender's address, recipient's address
    # and message to send - here it is sent as one string.

    print msg.as_string()

    s.sendmail(me, you, msg.as_string())
    s.quit()


if __name__ == "__main__":
    main()
