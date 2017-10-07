<?php
    include 'objects/movie.php';
    include 'objects/users.php';

    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
    ini_set('session.gc-maxlifetime', 60 * 60 * 24 * 365);
    session_start();

    $movieArray = array();

    //var_dump($_SESSION['favoriteMovies']);

    $conn = mysqli_connect('localhost','root','');
    if (mysqli_connect_errno())
		{
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
		}




    mysqli_select_db($conn,'dva231');
    $result = mysqli_query($conn, "SELECT * FROM movies");
    //echo $result;
    $json = file_get_contents("https://api.themoviedb.org/3/movie/popular?api_key=797b711215e70b7e890d5aa62ce6ab70&language=en-US&page=1s");
    $obj = json_decode($json);
    $obj = $obj->results;
    $i = 0;
    foreach ($obj as $value) {
      $i++;    
      array_push($movieArray, new Movie($value->id, $value->title, $value->overview, $value->poster_path));
      if($i > 8) break;
    }
    
    
    /*
    while( $row = mysqli_fetch_array($result))
    {
      array_push($movieArray, new movie($row[0], $row[1], $row[2], $row[3]));
    }
    */
    if(isset($_SESSION['user']))
    {
    $res = mysqli_query($conn, "SELECT movie_id FROM favorite_movies
			WHERE user_id=" . $_SESSION['user']->id .
			";" );

			unset($_SESSION['favoriteMovies']);
      $_SESSION['favoriteMovies'] = array();

			while( $row = mysqli_fetch_array($res))
			{
				array_push($_SESSION['favoriteMovies'], $row[0]);
			}
    }
    mysqli_close($conn);





    //Start our session.

    //Expire the session if user is inactive for 30
    //minutes or more.
    $expireAfter = 1;

    //Check to see if our "last action" session
    //variable has been set.
    if(isset($_SESSION['last_action'])){

         //Figure out how many seconds have passed
         //since the user was last active.
         $secondsInactive = time() - $_SESSION['last_action'];

         //Convert our minutes into seconds.
         $expireAfterSeconds = $expireAfter * 600000;

         //Check to see if they have been inactive for too long.
         if($secondsInactive >= $expireAfterSeconds){
           //User has been inactive for too long.
           //Kill their session.
           session_unset();
           session_destroy();
           Header('Location: '.$_SERVER['PHP_SELF']);
        }
    }

    //Assign the current timestamp as the user's
    //latest activity
    $_SESSION['last_action'] = time();
 ?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Lab 1 - Part II</title>


    <link rel="stylesheet" href="2.css">

    <!--MatirialIcons-->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--FontAwsomeIcons-->
    <link rel="stylesheet" href="font-awesome-4.7.0\font-awesome-4.7.0\css\font-awesome.css">
    <link rel="stylesheet" href="font-awesome-4.7.0\font-awesome-4.7.0\css\font-awesome.min.css">


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.js"></script>

  </head>
  <body>




    <header>
        <div class="headerWraper">
          <div class="logo">
            <!--<img src="logos/imdb.ico" alt="icon">-->
            <i class="fa fa-imdb fa-5x" aria-hidden="true"></i>
          </div>

          <div class="headerContent">

            <div class="upperHeader">

              <div class="upperHeaderLeft">
                <input class="widthOfSearchBar" id="namanyay-search-box" name="q" size="40" type="text" placeholder="Search..."/>

                <select class="searchDropDown" name="searchDropDown">

                  <option value="">All</option>
                  <option value="">Titles</option>
                  <option value="">Tv Epesodes</option>


                </select>

                <!--  <img class="buttonBackground" src="buttons/search.svg" alt="search"> -->

                <i class="material-icons searchButton">search</i>



              </div>

              <div class="upperHeaderRight">

                <div class="imdbPro">
                    <span class="white">imdb</span><span class="blue">Pro</span>
                    <div class="arrow-down"></div>
                </div>

                <span class="line">|</span>
                <a class="noDecorationLink"href="#">Help</a>

                <div class="imageLinks">
                  <i class="fa fa-facebook-official fa-2x backgroundColorForIcons" aria-hidden="true"></i>
                  <i class="fa fa-twitter-square fa-2x backgroundColorForIcons" aria-hidden="true"></i>
                  <i class="fa fa-instagram fa-2x backgroundColorForIcons" aria-hidden="true"></i>
                </div>


              </div>

            </div>

            <div class="bottomHeader">

              <div class="dropDowns">
                  <div class="oneDropDown">

                      <div class="grayBar"></div>
                      <a href="#">Movies, Tv & Showtimes</a>

                      <ul class="dropdown-menu">
                          <ul class="multi-column-dropdown">
                            <li><strong><a <h5 style="color:#A58500">MOVIES</h5></a></strong></li>
                            <li><a href="#">In Theaters</a></li>
                            <li><a href="#">Showtimes & Tickets</a></li>
                            <li><a href="#">Latest Trailers</a></li>
                            <li><a href="#">Coming Soon</a></li>
                            <li><a href="#">Release Calendar</a></li>
                            <li><a href="#">Top Rated Movies</a></li>
                            <li><a href="#">Top Rated Indian Movies</a></li>
                            <li><a href="#">Most Popular Movies</a></li>
                          </ul>
                            <ul class="multi-column-dropdown">
                              <li><strong><a <h5 style="color:#A58500">TV & VIDEO</h5></a></strong></li>
                              <li><a href="#">IMDb TV</a></li>
                              <li><a href="#">On Tonight</a></li>
                              <li><a href="#">Top Rated TV Shows</a></li>
                              <li><a href="#">Most Popular TV Shows</a></li>
                              <li><a href="#">DVD & Bluy</a></li>
                              <li><strong><a <h5 style="color:#A58500">SPECIAL FEATURES</h5></a></strong></li>
                              <li><a href="#">Amazon Originals</a></li>
                              <li><a href="#">Streaming</a></li>
                            </ul>
                            <div class="dropdownPic1"></div>
                      </ul>



                      <div class="arrow-down">

                      </div>
                  </div>


                  <div class="oneDropDown">
                      <a href="#">Celebs, Events & Photos</a>

                      <ul class="dropdown-menu">
                          <ul class="multi-column-dropdown">
                            <li><strong><a <h5 style="color:#A58500">MOVIES</h5></a></strong></li>
                            <li><a href="#">In Theaters</a></li>
                            <li><a href="#">Showtimes & Tickets</a></li>
                            <li><a href="#">Latest Trailers</a></li>
                            <li><a href="#">Coming Soon</a></li>
                            <li><a href="#">Release Calendar</a></li>
                            <li><a href="#">Top Rated Movies</a></li>
                            <li><a href="#">Top Rated Indian Movies</a></li>
                            <li><a href="#">Most Popular Movies</a></li>
                          </ul>
                            <ul class="multi-column-dropdown">
                              <li><strong><a <h5 style="color:#A58500">TV & VIDEO</h5></a></strong></li>
                              <li><a href="#">IMDb TV</a></li>
                              <li><a href="#">On Tonight</a></li>
                              <li><a href="#">Top Rated TV Shows</a></li>
                              <li><a href="#">Most Popular TV Shows</a></li>
                              <li><a href="#">DVD & Bluy</a></li>
                              <li><strong><a <h5 style="color:#A58500">SPECIAL FEATURES</h5></a></strong></li>
                              <li><a href="#">Amazon Originals</a></li>
                              <li><a href="#">Streaming</a></li>
                            </ul>
                            <div class="dropdownPic1"></div>
                      </ul>

                      <div class="arrow-down">

                      </div>
                  </div>

                  <div class="oneDropDown">
                      <a href="#">News & Community</a>


                      <ul class="dropdown-menu">
                          <ul class="multi-column-dropdown">
                            <li><strong><a <h5 style="color:#A58500">MOVIES</h5></a></strong></li>
                            <li><a href="#">In Theaters</a></li>
                            <li><a href="#">Showtimes & Tickets</a></li>
                            <li><a href="#">Latest Trailers</a></li>
                            <li><a href="#">Coming Soon</a></li>
                            <li><a href="#">Release Calendar</a></li>
                            <li><a href="#">Top Rated Movies</a></li>
                            <li><a href="#">Top Rated Indian Movies</a></li>
                            <li><a href="#">Most Popular Movies</a></li>
                          </ul>
                            <ul class="multi-column-dropdown">
                              <li><strong><a <h5 style="color:#A58500">TV & VIDEO</h5></a></strong></li>
                              <li><a href="#">IMDb TV</a></li>
                              <li><a href="#">On Tonight</a></li>
                              <li><a href="#">Top Rated TV Shows</a></li>
                              <li><a href="#">Most Popular TV Shows</a></li>
                              <li><a href="#">DVD & Bluy</a></li>
                              <li><strong><a <h5 style="color:#A58500">SPECIAL FEATURES</h5></a></strong></li>
                              <li><a href="#">Amazon Originals</a></li>
                              <li><a href="#">Streaming</a></li>
                            </ul>
                            <div class="dropdownPic1"></div>
                      </ul>

                      <div class="arrow-down">

                      </div>
                  </div>

                  <div class="oneDropDown">
                      <a href="#">Watchlist</a>

                      <ul class="dropdown-menu">
                          <ul class="multi-column-dropdown">
                            <li><strong><a <h5 style="color:#A58500">MOVIES</h5></a></strong></li>
                            <li><a href="#">In Theaters</a></li>
                            <li><a href="#">Showtimes & Tickets</a></li>
                            <li><a href="#">Latest Trailers</a></li>
                            <li><a href="#">Coming Soon</a></li>
                            <li><a href="#">Release Calendar</a></li>
                            <li><a href="#">Top Rated Movies</a></li>
                            <li><a href="#">Top Rated Indian Movies</a></li>
                            <li><a href="#">Most Popular Movies</a></li>
                          </ul>
                            <ul class="multi-column-dropdown">
                              <li><strong><a <h5 style="color:#A58500">TV & VIDEO</h5></a></strong></li>
                              <li><a href="#">IMDb TV</a></li>
                              <li><a href="#">On Tonight</a></li>
                              <li><a href="#">Top Rated TV Shows</a></li>
                              <li><a href="#">Most Popular TV Shows</a></li>
                              <li><a href="#">DVD & Bluy</a></li>
                              <li><strong><a <h5 style="color:#A58500">SPECIAL FEATURES</h5></a></strong></li>
                              <li><a href="#">Amazon Originals</a></li>
                              <li><a href="#">Streaming</a></li>
                            </ul>
                            <div class="dropdownPic1"></div>
                      </ul>

                      <div class="arrow-down">

                      </div>
                  </div>

              </div>


              <div class="links">


              <?php



            	if( !isset($_SESSION['user']) )
            	{


               ?>

                <a href="#" class="facebookSingIn">
                  <span>
                    <i class="fa fa-facebook-official" aria-hidden="true">
                    </i>
                  </span>
                  <span class="facebookSingInText">
                    Sign in with Facebook
                  </span>
                </a>

                <a class="commonLink" href="login.php">
                  Other sign in options
                </a>

              <?php
              }
              else
              {
                ?>
                <p class="commonLink">
              <?php
                echo "Hello " . $_SESSION['user']->username;
              ?>
                </p>

               <div class="facebookSingIn" >
                  <button class="logOutButton" onCLick="logOut()" type="submit" name="submit" name="button">Log out</button>
               </div>

               <?php
             }
                ?>


              </div>


            </div>

          </div>


      </div>

    </header>







    <div class="wrapper">
      <main>
        <div class="postersArea">



          <div class="posters">

            <?php
              for($i = 0; $i < count($movieArray); $i++){
            ?>

            <div class="poster">
              <div class="poster-content-wrapper">
                <?php if( isset($_SESSION['user']))
                {
                  if( isset($_SESSION['favoriteMovies']) &&
								   in_array($movieArray[$i]->id, $_SESSION['favoriteMovies']) ) {
                  ?>
								  <div
                  onClick="removeFromFavoritesAjax(<?php print_r($movieArray[$i]->id) ?>,
                  '<?php print_r($movieArray[$i]->title) ?>')"
                    class="click-star poster1">
									<a href="#">
                    <i id="<?php print_r($movieArray[$i]->id) ?>" class="material-icons active">star</i>
                  </a>
								  </div>
								<?php
                }
								else
                  {
								  ?>

								  <div
                  onClick="addToFavoritesAjax(<?php print_r($movieArray[$i]->id) ?>
                  ,'<?php print_r($movieArray[$i]->title) ?>')"
                    class="click-star poster1">
									           <a
									           href="#"><i id="<?php print_r($movieArray[$i]->id) ?>"
                                class="material-icons">star_border</i></a>
								  </div>
								  <?php
								  }
								}
								 ?>




                <img src="https://image.tmdb.org/t/p/w185<?php print_r($movieArray[$i]->posterUrl); ?> " alt="poster">

                <div class="aboutPoster">
                <h3><?php   print_r($movieArray[$i]->title); ?></h3>
                <p> <?php print_r($movieArray[$i]->description); ?> </p>
                </div>

                </div>

                <div class="spacer"><!--work around jquery's auto width calculation-->
                </div>

            </div>

            <?php } ?>

          </div>

                  <p class="seemore">
                    <a href="#">Browse trailers</a>
                  </p>




                </div>


          <?php
          for($i=0; $i < 3; $i++) { ?>

          <div class="articleArea">

            <h1>It's Emmys Week: Unforgettable Emmy Photos</h1>

            <p>
              Rewind with some of the most memorable photos
              from past Primetime Emmy Awards.
              Join us Sunday for IMDb LIVE After
              the Emmys for exclusive winners interviews and more.
            </p>

            <div class="imagesInArtice">

              <!--<img src="photo/got.jpg" alt="gotimage">-->
              <iframe src="https://www.youtube.com/embed/1Mlhnt0jMlg"
              frameborder="0" allowfullscreen></iframe>

              <img src="photo/got1.jpg" alt="gotimage">

            </div>

            <p class="seemore"><a href="#">See more</a></p>


          </div>

        <?php } ?>


      </main>







      <aside>
        <div class="asideLinks">

          <h3>Opening This week</h3>

          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">Mother!</a>
            </div>


          </div>

          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">American Assassin</a>
            </div>

            <div class="asideLimited">Limited</div>


          </div>

          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">Brad's Status</a>
            </div>

            <div class="asideLimited">Limited</div>


          </div>

          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">Rebel in the Rye</a>
            </div>

            <div class="asideLimited">Limited</div>


          </div>

          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">Because Of Grácia</a>
            </div>

            <div class="asideLimited">Limited</div>


          </div>



          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">Woodpeckers</a>
            </div>

          </div>



          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">In Search of Fellini</a>
            </div>

            </div>

            <p class="seemore"><a href="#">See more opening this week</a></p>

        </div>


        <div class="asideLinks">

          <h3>Opening This week</h3>

          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">Mother!</a>
            </div>


          </div>

          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">American Assassin</a>
            </div>

            <div class="asideLimited">Limited</div>


          </div>

          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">Brad's Status</a>
            </div>

            <div class="asideLimited">Limited</div>


          </div>

          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">Rebel in the Rye</a>
            </div>

            <div class="asideLimited">Limited</div>


          </div>

          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">Because Of Grácia</a>
            </div>

            <div class="asideLimited">Limited</div>


          </div>



          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">Woodpeckers</a>
            </div>

          </div>



          <div class="asideRow">
            <div class="linkWrapper">
              <i class="material-icons">bookmark<i class="fa fa-plus" aria-hidden="true"></i></i>
              <a href="#">In Search of Fellini</a>
            </div>

            </div>

            <p class="seemore"><a href="#">See more opening this week</a></p>

        </div>

      </aside>

    </div>

    <script>

        $('.posters').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          dots:false,
          arrows: false,
        });

        function logOut(){
          window.location.replace("logOutProcess.php");
        }

        function addToFavoritesAjax(movieID, title) {
          //var for_send = JSON.stringify(movieID);
          //alert(for_send);

          var sendData = {'id': JSON.stringify(movieID),
                'title': title};
          console.log(sendData);

          /*$.post('addToFavoritesInDB.php', sendData,
           function () {
           }).done(function (data) {
              console.log(data);
          }, "json");*/

        //  return;
          $.ajax({
            url:'addToFavoritesInDB.php',
            type: 'POST',
            dataType: 'json',
            data: sendData,
            success: function(data) {
              debugger;
                console.log(data);
                $('#'+data['id'])[0].className = null;
                $('#'+data['id'])[0].className = 'material-icons active';
                $('#'+data['id']).html('star');
                $('#'+data['id']).closest('div').attr('onclick',"removeFromFavoritesAjax("
                + data['id'] +",'"+data['title'] +"')");
                alert("You have succesfully add " + data['title'] + " as your favorite movie.");
              },
            error: function(r, status, error) {
              debugger;
                alert("ERROR:" + r.responseText + " " + error);
              }
          })

        }



        function removeFromFavoritesAjax(movieID, title) {
          var sendData = {'id': JSON.stringify(movieID),
                'title': title};
            $.ajax({
              url:'RemoveFromFavoritesInDB.php',
              type: 'POST',
              dataType: 'json',
              data: sendData,
              success: function(data) {
                debugger;
                  $("#"+data['id'])[0].className = null;
                  $("#"+data['id'])[0].className = 'material-icons';
                  $('#'+data['id']).html('star_border');
                  alert("You have succesfully removed " + data['title'] + " from your favorite list.");
                },
              error: function(r, status, error) {
                debugger;
                  alert("ERROR:" + r.responseText);
                }
            })
          }


        function starButton(id, name){
	        if ($(id+' span').hasClass("fa-star")) {
            //TRANSPARENT
			      $(id).removeClass('active')
          setTimeout(function() {
            $(id+ ' span').removeClass('fa-star')
            $(id+' span').addClass('fa-star-o')
          }, 15)
          //UNSET
          } else {
            //YELLOW
            $(id).addClass('active')
            setTimeout(function() {
              $(id+' span').addClass('fa-star')
              $(id+' span').removeClass('fa-star-o')
            }, 150)
            //GET
            window.location.href = "addToFavorites.php?movieName="+name;
          }

        }


  </script>



  </body>
</html>
