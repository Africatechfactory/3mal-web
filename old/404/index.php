<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    <link rel="stylesheet" href="../css/font-awesome/css/all.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>

    <style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;700&family=Bebas+Neue&family=Rampart+One&family=Poppins:wght@400;500;800;900&display=swap');
        .hero_bg {
            background-color: #f1f1f1;
            width: 100%;
            height: 100vh;
            position: relative;
        }
        .hero_bg .inner_box {
            background:#fff;
            box-shadow: 0px 5px 5px 0px rgba(0,0,0,.1);
            width: 80%;
            height: 80vh;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .hero_bg .inner_box .box_inner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* border: 1px solid #ddd; */
            text-align: center;
        }
        .hero_bg .inner_box .box_inner h1 {
           font-size: 10em;
           color: #000;
           font-family: 'Bebas Neue', cursive;
           margin-bottom: 0;
           line-height: 1;
        }
        .hero_bg .inner_box .box_inner .top_p {
           margin-bottom: 0;
           color: #aeaeae;
           font-family: 'Poppins', sans-serif;
           text-transform: uppercase;
           font-size: 12px;
           font-weight: 500;
        }
        .hero_bg .inner_box .box_inner .bottom_p {
           margin-bottom: 0;
           color: #232323;
           font-family: 'Poppins', sans-serif;
           text-transform: uppercase;
           font-size: 11px;
           font-weight: 600;
        }
        .hero_bg .inner_box .box_inner .home_btn {
            text-decoration: none;
           color: #000;
           font-family: 'Poppins', sans-serif;
           text-transform: uppercase;
           font-size: 11px;
           font-weight: 600;
           border: 2px solid #000;
           margin-top: 20px;
           padding: 8px 50px;
           border-radius: 20px;
           transition: .5s ease-in-out;
           background: #fff;
        }
        .hero_bg .inner_box .box_inner .home_btn:hover {
           color: #fff;
           background: #000;
        }
        @media screen and (max-width:950px){
            .hero_bg .inner_box {
            width: 90%;
            height: 90vh;
        }
        .hero_bg .inner_box .box_inner .bottom_p {
           font-size: 10px;
        }
        }
    </style>
</head>
<body>
<div class="container-fluid hero_bg">
    <div class="inner_box">
        <div class="box_inner">
            <p class="top_p">oops! page not found</p>
            <h1>404</h1>
            <p class="bottom_p">we are sorry, but the page your <br> requested for was not found.</p>
            <a href="../" class="home_btn btn">Home</a>
        </div>
    </div>
</div>
</body>
</html>