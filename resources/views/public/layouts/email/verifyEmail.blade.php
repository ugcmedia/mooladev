
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

    <body itemscope itemtype="http://schema.org/EmailMessage">
      <style>
        .button {

        }
        </style>
      <h2>Verify Your Email Address</h2>
            <div>
                You registration is successful verify your email before proceeding by clicking the link below.
                <a href="{{ url(  'verifyMail/' . $confirmation_code) }}" style="background-color: #4CAF50; border: none;color: white; padding: 10px 20px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">
                    Verify
                </a><br/>

            </div>
    </body>

</html>
