<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['html','form','url','common'];

    protected $session;
    //protected $request;
    protected $validation;

    public $userModel;
    public $nominationTypesModel;
    public $nominationModel;
    public $categoryModel;
    public $awardsModel;
    public $juryModel;
    public $nomineeModel;
    public $ratingModel;
    public $registerationModel;
    public $roleModel;
    public $workshopModel;
    public $extendModel;
    public $awardsCategoryModel;
   
    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        
        $this->userModel            = model('App\Models\UserModel');
        $this->nominationTypesModel = model('App\Models\NominationTypesModel');
        $this->nominationModel      = model('App\Models\NominationModel');
        $this->categoryModel        = model('App\Models\CategoryModel');
        $this->juryModel            = model('App\Models\JuryModel');
        $this->awardsModel          = model('App\Models\AwardsModel');
        $this->nomineeModel         = model('App\Models\NomineeModel');
        $this->ratingModel          = model('App\Models\RatingModel');
        $this->registerationModel   = model('App\Models\RegisterationModel');
        $this->roleModel            = model('App\Models\RoleModel');
        $this->workshopModel        = model('App\Models\WorkshopModel');
        $this->extendModel          = model('App\Models\ExtendModel');
        $this->awardsCategoryModel  = model('App\Models\AwardsCategoryModel');
        $this->contactModel         = model('App\Models\ContactModel');

        $this->session     = \Config\Services::session();
      //  $this->request     = \Config\Services::request();
        $this->validation  = \Config\Services::validation();

    }
}
