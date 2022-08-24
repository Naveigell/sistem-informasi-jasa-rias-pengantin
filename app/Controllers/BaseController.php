<?php

namespace App\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
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
    protected $helpers = ['string', 'currency', 'html', 'calculation', 'static'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $nonExpiredBookings = (new Booking())->where('is_expired', 0)->where('DATE(expired_at) <=', Time::now()->toDateString())->findAll();

        foreach ($nonExpiredBookings as $booking) {
            $payment = (new Payment())->where('booking_id', $booking['id'])->first();

            if (!$payment || $payment['status'] === Payment::STATUS_WAITING_PAYMENT) {
                (new Booking())->update($booking['id'], [
                    "is_expired" => 1,
                ]);
            }
        }
    }
}
