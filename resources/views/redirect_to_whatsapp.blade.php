<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to WhatsApp</title>
</head>
<body>
    <script type="text/javascript">
        window.location.href = "https://api.whatsapp.com/send?phone=919676926268&text={{ $whatsapp_url }}";
        setTimeout(function(){
            window.location.reload();
        }, 5000);
    </script>
</body>
</html>