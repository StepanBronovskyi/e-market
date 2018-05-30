<?php

    class Blog {

        public static function getBlogsList() {
            $blogsList = array();

            $db = Db::getConnection();
            $query = "SELECT * FROM blog";

            $result = $db->query($query);

            $num = $result->num_rows;

            for($i = 0; $i < $num; ++$i) {
                $result->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $blogsList[$i]['title'] = $row['title'];
                $blogsList[$i]['id'] = $row['id'];
                $blogsList[$i]['author'] = $row['author'];
                $blogsList[$i]['date'] = $row['date'];
                $blogsList[$i]['short_content'] = $row['short_content'];
            }
            return $blogsList;
        }

        public static function getNewsById($id) {
            $news = array();

            $db = Db::getConnection();
            $query = "SELECT * FROM blog WHERE id='$id'";
            $result = $db->query($query);

            $result->data_seek(0);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $news['id'] = $row['id'];
            $news['title'] = $row['title'];
            $news['author'] = $row['author'];
            $news['date'] = $row['date'];
            $news['content'] = $row['content'];

            return $news;
        }
    }