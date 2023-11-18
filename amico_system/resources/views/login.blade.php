<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "res/css/loginpage.css" />
    <title>Document</title>
</head>
<body>
    <div class="container">
        <section>
            <div class="page">
                <div class="maincontainer">
                    <div class="left">
                        <div class="login">Login</div>
                        <div class="welcome">
                            <p>hello</p>
                        </div>
                        <svg viewBox="0 0 320 300">
                            <defs>
                                <linearGradient
                                    inkscape:collect="always"
                                    id="linearGradient"
                                    x1="13"
                                    y1="193.49992"
                                    x2="307"
                                    y2="193.49992"
                                    gradientUnits="userSpaceOnUse">
                                    <stop
                                        style="stop-color:#ff00ff;"
                                        offset="0"
                                        id="stop876" />
                                    <stop
                                        style="stop-color:#ff0000;"
                                        offset="1"
                                        id="stop878" />
                                </linearGradient>
                            </defs>
                            <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
                        </svg>
                        <div class="form">
                            <form action = "loginpage" method = "POST">
                            <!-- cross-site request forgery -->
                            @csrf
                            <label for="number">Number</label>
                            <input class = "log" type="text" id="number" name = "number">

                            <label for="password">Password</label>
                            <input class = "log" type="password" id="password" name="password">

                            <input class = "log" type="submit" id="submit" value="Submit">
                            </form>

                            @if(session('error'))
                                <p class="error">{{ session('error') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="right">
                        <div class="eula">
                            <img src = "images/logo.png" class = "logo">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section> 
            <div class="heading">
                <h1>About AMICO</h1>
                <p>The Asset Management Inventory Control Office (AMICO) is responsible for managing the assets of 
                Saint Louis University. AMICO handles the items that go in and out of the capital assets.</p>
            </div>
            <div class="about-container">
                <div class="about">
                    <div class="about-image">
                        <img src="images/slu.png">
                    </div>
                    <div class="about-content">
                        <h2> Vision and Mission </h2>
                    <p>In partnership with our stakeholders, the Asset Management and Inventory Control 
                    Office envisions safeguarding all assets of Saint Louis University
                    and encouraging them to be good stewards of the things entrusted to us.
                    The Asset Management and Inventory Control Office are committed to continuously 
                    developing and improving the effectiveness in managing all assets of
                    Saint Louis University aligned with the direction of Saint Louis University 
                    that are creative, competent, socially involved, and imbued with a Christian spirit.</p>
                    <h2> Objective of AMICO </h2>
                <p>The Asset Management Inventory Control Office (AMICO) at Saint Louis University is 
                    dedicated to enhancing the efficacy of asset management through a multifaceted approach. 
                    This includes fortifying policies and procedures for meticulous asset oversight, 
                    promoting a culture of responsible stewardship, establishing and verifying the integrity 
                    of asset records, validating and accounting for all assets, and systematically assessing 
                    the conditions and functionality of property and equipment. This comprehensive strategy 
                    underscores AMICO's commitment to ensuring the proper and transparent management of Saint Louis University's diverse assets.
</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div>
                <h1>THE DEVELOPERS</h1>
            </div>
            <div class="row">
                <!-- Column 1-->
                <div class="column">
                    <div class="card">
                        <div class="img-container">
                            <img src="images/rovin.png" />
                        </div>
                        <h3>Rovin Matthew Navarro</h3>
                        <p>Team Leader</p>
                    </div>
                </div>

                <!-- Column 2-->
                <div class="column">
                    <div class="card">
                        <div class="img-container">
                            <img src="images/godric.png" />
                        </div>
                        <h3>Godric Egon Neal Tampinco</h3>
                        <p>LEAD Developer</p>
                    </div>
                </div>

                <!-- Column 3-->
                <div class="column">
                    <div class="card">
                        <div class="img-container">
                            <img src="images/olsen.png" />
                        </div>
                        <h3>Olsen Daim Valente</h3>
                        <p>Database</p>
                    </div>
                </div>
                

                <!-- Column 4-->
                <div class="column">
                    <div class="card">
                        <div class="img-container">
                            <img src="images/marc.png" />
                        </div>
                        <h3>Marc Justin Ramos</h3>
                        <p>Database</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Column 1-->
                <div class="column">
                    <div class="card">
                        <div class="img-container">
                            <img src="images/paj.png" />
                        </div>
                        <h3>Prince Jefferson De Guzman</h3>
                        <p>Developer na ngayon</p>
                    </div>
                </div>

                <!-- Column 2-->
                <div class="column">
                    <div class="card">
                        <div class="img-container">
                            <img src="images/roms.png" />
                        </div>
                        <h3>Romuel Lacuesta</h3>
                        <p>Developer na ngayon</p>
                    </div>
                </div>

                <!-- Column 3-->
                <div class="column">
                    <div class="card">
                        <div class="img-container">
                            <img src="images/cyver.png" />
                        </div>
                        <h3>Cyver Grant Rafael</h3>
                        <p>System Analyst</p>
                    </div>
                </div>

                <!-- Column 4-->
                <div class="column">
                    <div class="card">
                        <div class="img-container">
                            <img src="images/adrian.png" />
                        </div>
                        <h3>Adrian Salinas</h3>
                        <p>System Analyst</p>
                    </div>
                </div>
            </div>

        </section>
    </div>
    
    

</body>
<script src = "res/js/loginpage.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</html>

