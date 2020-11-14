  <?
                  

                  $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

                  $page_current = $request_uri[1];
//if (array_key_exists("Volvo",$a))

$page_list = array();

$page_list['main'] = array("name"=>"Главная", "pic"=>"database", "link"=>"/page/main/");
$page_list['scan'] = array("name"=>"Сканирование", "pic"=>"camera", "link"=>"/page/scan/");
$page_list['analytics'] = array("name"=>"Аналитика", "pic"=>"bar-chart-2", "link"=>"/page/analytics/");



                  ?>



<nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">


<?foreach ($page_list as $key => $value){?>



   <li class="nav-item">
      <a class="nav-link <?if($page_current == $key) echo "active";?>" href="<?=$value['link']?>">
        <span data-feather="<?=$value['pic']?>"></span>
        <?=$value['name']?> <?if($page_current == $value['link']) echo '<span class="sr-only">(current)</span>'?>
      </a>
    </li>





<?}?>



            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Current month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Last quarter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Social engagement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Year-end sale
                </a>
              </li>
            </ul>
          </div>
        </nav>

