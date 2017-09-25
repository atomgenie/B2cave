<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88928163-1', 'auto');
  ga('send', 'pageview');

</script>
              <table id="tableHeader">
               <tr>
                   <td>
                       <h1 onclick="window.location.href = '/b2cave';">B2 Cave</h1>
                   </td>
                   <td>
                       <p>
                          <?php
                                if($co){
                                    echo $donnees['name'];
                                }
                           else{
                               ?>
                                <a href="https://login.microsoftonline.com/common/oauth2/v2.0/authorize?client_id=8763bc24-83ea-4713-b71c-38aa18407590&response_type=code
&redirect_uri=https://b2cave.tamtanguy.fr/b2cave/php/connect.php&response_mode=query&scope=User.Read">Se connecter</a>
                      <?php
                           }
                           ?>
                       </p>
                   </td>
               </tr>
           </table>