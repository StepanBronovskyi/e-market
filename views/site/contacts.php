<?php include (ROOT."/views/layouts/header.php");?>

    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if($result):?>
                    <h2>Ждите ответа</h2>
                <?php else:?>

                    <?if(is_array($errors)):?>
                        <ul>
                            <?php foreach($errors as $error):?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif;?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Отправка сообщения</h2>
                        <form action="#" method="post">
                            <input type="email" name="email" placeholder="E-mail" value=""/>
                            <input type="text" name="text" placeholder="Message" value=""/>
                            <input type="submit" name="submit" class="btn btn-default" value="Send" />
                        </form>
                    </div><!--/sign up form-->
                 <?php endif;?>

                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </section>


<?php include ROOT."/views/layouts/footer.php";?>