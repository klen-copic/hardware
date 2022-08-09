<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\RatingModel;
use App\Models\UserModel;
use App\Models\VideoModel;

class Features extends BaseController
{

    public function index()
    {

        $videoModel = new VideoModel();

        $data['videos'] = $videoModel->findAll();

        $categories = $videoModel->getCategories();
        foreach ($categories as &$category) {
            $category['category'] = ucfirst($category['category']);
        }
        $data['categories'] = $categories;
        $data['title'] = 'Videos';

        echo view('templates/header', $data);
        echo view('features/videos', $data);
        echo view('templates/footer', $data);
    }

    public function display($videos)
    {
        echo view('features/display', ['videos' => $videos]);
    }

    public function profile()
    {

        $videoModel = new VideoModel();
        $data['videos'] = $videoModel->where('userID', session()->get('id'))->findAll();

        $ratingModel = new RatingModel();

        //find total number of uploaded videos
        $data['totalVideos'] = $videoModel->where('userID', session()->get('id'))->countAllResults();

        //find total number of ratings
        $avgRatings = $ratingModel->averagePerVideo(session()->get('id'));

        $avg = 0;

        if ($data['totalVideos'] === 0) {
            $data['averageRating'] = 0;
        } else {
            foreach ($avgRatings as &$rating) {
                $avg += $rating['averageRating'];
            }
            $data['averageRating'] = $avg / $data['totalVideos'];
        }

        $userModel = new UserModel();

        $data['user'] = $userModel->find(session()->get('id'));

        $data['title'] = 'Profile Page';
        echo view('templates/header', $data);
        echo view('features/profile', $data);
        echo view('templates/footer');

    }

    /**
     * @throws \ReflectionException
     */
    public function uploadVideo()
    {


        $video = $this->request->getFile('file');

        $file_type = $video->getClientMimeType();

        $valid_file_types = array("video/webm", "video/mp4", "video/ogg");

        if (in_array($file_type, $valid_file_types)) {

            $rules = [
                'title' => 'required|min_length[3]|max_length[100]',
                'description' => 'required|min_length[3]|max_length[1000]',
                'category' => 'required|min_length[3]|max_length[50]',
            ];

            if ($this->validate($rules)) {

                $fileName = $video->getRandomName();
                $video->move('uploads', $fileName);

                $data = [
                    'title' => $this->request->getVar('title'),
                    'description' => $this->request->getVar('description'),
                    'category' => $this->request->getVar('category'),
                    'userID' => session()->get('id'),
                    'videoLocation' => $video->getName(),
                    'createdAt' => date('Y-m-d'),
                    'updatedAt' => date('Y-m-d'),
                ];

                $videoModel = new VideoModel();

                $videoModel->save($data);

                return "ok";

            } else {

                $data['validation'] = $this->validator;
                return $data['validation']->listErrors();
            }

        } else {
            return "Invalid File Type";
        }
    }

    public function view($id)
    {

        $videoModel = new VideoModel();
        $video = $videoModel->getVideo($id);
        $data = [
            'video' => $video
        ];

        $ratingModel = new RatingModel();

        $userRating = $ratingModel->where('userID', session()->get('id'))->where('videoID', $id)->first();

        if ($userRating <> NULL) {
            $data['userRating'] = $userRating['stars'];  // If user has already rated the item, display their rating
        } else {
            $data['userRating'] = "0";
        }

        $averageRating = $ratingModel->where('videoID', $id)->selectAvg('stars')->first();

        if ($averageRating['stars'] <> NULL) {
            $data['averageRating'] = $averageRating['stars'];  // If there are ratings, display the average rating
        } else {
            $data['averageRating'] = 0;
        }

        $commentModel = new CommentModel();

        $comments = $commentModel->getComments($video['id']);
        $data['comments'] = $comments;

        $data['title'] = $video['title'];
        echo view('templates/header', $data);
        echo view('features/video', $data);
        echo view('templates/footer');
    }

    public function updateRating()
    {

        $ratingModel = new RatingModel();

        $userID = session()->get('id');
        $videoID = $this->request->getVar('videoID');
        $rating = $this->request->getVar('rating');

        $averageRating = $ratingModel->userRating($userID, $videoID, $rating);

        echo $averageRating;
    }

    public function postComment()
    {
        $commentModel = new CommentModel();
        $data = [
            'userID' => session()->get('id'),
            'videoID' => $this->request->getVar('videoID'),
            'text' => $this->request->getVar('text')
        ];
        $commentModel->save($data);
        return "ok";
    }

    public function filterVideos()
    {

        $videoModel = new VideoModel();
        $category = strtolower($this->request->getVar('filter'));
        $videos = $videoModel->where('category', $category)->findAll();

        $response = $this->display($videos);

        echo $response;
    }

    public function searchVideos()
    {

        $videoModel = new VideoModel();
        $keyword = $this->request->getVar('text');
        $videos = $videoModel->search($keyword);

        $response = $this->display($videos);

        echo $response;

    }

    public function user($id) {

        $videoModel = new VideoModel();
        $videos = $videoModel->where('userID', $id)->findAll();

        $userModel = new UserModel();

        $user = $userModel->select('firstName, lastName, phoneNumber, email')->where('id', $id)->first();

        $data = [
            'videos' => $videos,
            'user' => $user
        ];

        $data['title'] = $user['firstName'] . ' ' . $user['lastName'];
        echo view('templates/header', $data);
        echo view('features/user', $data);
        echo view('templates/footer');

    }

    public function deleteVideo()
    {
        $videoModel = new VideoModel();

        $id = $this->request->getVar('id');

        $name = $videoModel->where("id", $id)->first()['videoLocation'];

        unlink('uploads/' . $name);

        $videoModel->where('id', $id)->delete();
        return "ok";
    }
}