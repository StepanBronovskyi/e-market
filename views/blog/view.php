<?php include (ROOT."/views/layouts/header.php")?>
<body>
<div id="wrapper">
    <div id="header">
        <div id="logo">
            <h1><a href="#">Culinary</a></h1>
        </div>
        <!-- end div#logo -->
    </div>
    <!-- end div#header -->
    <div id="menu">
        <ul>
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
    <!-- end div#menu -->
    <div id="page">
        <div id="page-bgtop">
            <div id="content">

                <div class="post">
                    <h2 class="title"><a href="/blog/<?php echo $newsItem['id'];?>"><?php echo $newsItem['title'];?></a></h2>
                    <br/>
                    <p><b><?php echo $newsItem['author'];?></b> at <?php echo $newsItem['date'];?></p>
                    <div class="entry">
                        <p><?php echo $newsItem['content'];?></p>
                    </div>
                    <div class="meta">
                        <p class="links"><a href="/blog/" class="comments">Back to all news</a></p>
                    </div>
                </div>



            </div>
            <!-- end div#content -->
            <div id="sidebar">
                <ul>
                    <li>
                        <h2 class="categories">Lorem Ipsum</h2>
                        <ul>
                            <li><a href="#">Fusce dui neque fringilla</a></li>
                            <li><a href="#">Eget tempor eget nonummy</a></li>
                            <li><a href="#">Magna lacus bibendum mauris</a></li>
                            <li><a href="#">Nec metus sed donec</a></li>
                            <li><a href="#">Magna lacus bibendum mauris</a></li>
                            <li><a href="#">Velit semper nisi molestie</a></li>
                            <li><a href="#">Eget tempor eget nonummy</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- end div#sidebar -->
            <div style="clear: both; height: 1px"></div>
        </div>
    </div>
    <!-- end div#page -->
    <div id="footer">
        <p>Copyright &copy; 2007</div>
    <!-- end div#footer -->
</div>
<!-- end div#wrapper -->
</body>
<?php include (ROOT."/views/layouts/footer.php")?>