<?php

namespace App\Http\Controllers\Payments\Verotel;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Pipisco\Verotel\FlexPay\Enums\UrlParameter;
use Pipisco\Verotel\FlexPay\FlexPayClient;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class VerotelController
 * @package App\Http\Controllers\Payments\Verotel
 */
class VerotelController
{

    /**
     * @var FlexPayClient
     */
    protected $flexpay;

    /**
     * Order name
     * @var string
     */
    protected $name                 = 'Test order';

    /**
     * Order description
     *
     * @var string
     */
    protected $description          = 'Test order transaction';

    /**
     * Price amount
     *
     * @var float
     */
    protected $price_amount         = 6.95;

    /**
     * Price Currency
     *
     * @var string
     */
    protected $price_currency       = 'USD';

    /**
     * Subscription type
     *
     * @var string
     */
    protected $subscription_type    = 'recurring';

    /**
     * Subscription Period
     *
     * @var string
     */
    protected $period               = 'P1M';

    /**
     * VerotelController constructor.
     */
    public function __construct()
    {
        $this->flexpay = new FlexPayClient();
    }

    /**
     * @param Request $request
     * @return View
     * @throws \Exception
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function subscriptionOrder(Request $request) : View
    {
        return view('subscription', [
            'url'              => $this->flexpay->processor()->subscription([
                UrlParameter::NAME              => $this->name,
                UrlParameter::DESCRIPTION       => $this->description,
                UrlParameter::SUBSCRIPTION_TYPE => $this->subscription_type,
                UrlParameter::PRICE_AMOUNT      => $this->price_amount,
                UrlParameter::PRICE_CURRENCY    => $this->price_currency,
                UrlParameter::PERIOD            => $this->period,
            ]),
            'name'              => $this->name,
            'description'       => $this->description,
            'price_amount'      => $this->price_amount,
            'price_currency'    => $this->price_currency,
            'period'            => $this->period,
        ]);
    }

    /**
     * @param Request $request
     * @return View
     * @throws \Exception
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function purchaseOrder(Request $request) : View
    {
        return view('purchase', [
            'url'              => $this->flexpay->processor()->purchase([
                UrlParameter::NAME              => $this->name,
                UrlParameter::DESCRIPTION       => $this->description,
                UrlParameter::SUBSCRIPTION_TYPE => $this->subscription_type,
                UrlParameter::PRICE_AMOUNT      => $this->price_amount,
                UrlParameter::PRICE_CURRENCY    => $this->price_currency,
                UrlParameter::PERIOD            => $this->period,
            ]),
            'name'              => $this->name,
            'description'       => $this->description,
            'price_amount'      => $this->price_amount,
            'price_currency'    => $this->price_currency,
            'period'            => $this->period,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function subscribe(Request $request) : RedirectResponse
    {
        return redirect($this->flexpay->processor()->subscription([
            UrlParameter::NAME              => $this->name,
            UrlParameter::SUBSCRIPTION_TYPE => $this->subscription_type,
            UrlParameter::PRICE_AMOUNT      => $this->price_amount,
            UrlParameter::PRICE_CURRENCY    => $this->price_currency,
            UrlParameter::PERIOD            => $this->period,
        ]));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function purchase(Request $request) : RedirectResponse
    {
        return redirect($this->flexpay->processor()->purchase([
            UrlParameter::DESCRIPTION       => $this->description,
            UrlParameter::SUBSCRIPTION_TYPE => $this->subscription_type,
            UrlParameter::PRICE_AMOUNT      => $this->price_amount,
            UrlParameter::PRICE_CURRENCY    => $this->price_currency,
            UrlParameter::PERIOD            => $this->period,
        ]));
    }

    /**
     * @param Request $request
     * @return Redirect
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function subscribeVerotelProcessor(Request $request) : Redirect
    {
        return redirect($this->flexpay->verotel()->subscription([
            UrlParameter::NAME              => $this->name,
            UrlParameter::DESCRIPTION       => $this->description,
            UrlParameter::SUBSCRIPTION_TYPE => $this->subscription_type,
            UrlParameter::PRICE_AMOUNT      => $this->price_amount,
            UrlParameter::PRICE_CURRENCY    => $this->price_currency,
            UrlParameter::PERIOD            => $this->period,
        ]));
    }

    /**
     * @param Request $request
     * @return Redirect
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function subscribeCardBilling(Request $request) : Redirect
    {
        return redirect($this->flexpay->cardBilling()->subscription([
            UrlParameter::NAME              => $this->name,
            UrlParameter::DESCRIPTION       => $this->description,
            UrlParameter::SUBSCRIPTION_TYPE => $this->subscription_type,
            UrlParameter::PRICE_AMOUNT      => $this->price_amount,
            UrlParameter::PRICE_CURRENCY    => $this->price_currency,
            UrlParameter::PERIOD            => $this->period,
        ]));
    }

    /**
     * @param Request $request
     * @return Redirect
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function subscribeBitsafePay(Request $request) : Redirect
    {
        return redirect($this->flexpay->bitsafePay()->subscription([
            UrlParameter::NAME              => $this->name,
            UrlParameter::DESCRIPTION       => $this->description,
            UrlParameter::SUBSCRIPTION_TYPE => $this->subscription_type,
            UrlParameter::PRICE_AMOUNT      => $this->price_amount,
            UrlParameter::PRICE_CURRENCY    => $this->price_currency,
            UrlParameter::PERIOD            => $this->period,
        ]));
    }

    /**
     * @param Request $request
     * @return Redirect
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function subscribeBill(Request $request) : Redirect
    {
        return redirect($this->flexpay->bill()->subscription([
            UrlParameter::NAME              => $this->name,
            UrlParameter::DESCRIPTION       => $this->description,
            UrlParameter::SUBSCRIPTION_TYPE => $this->subscription_type,
            UrlParameter::PRICE_AMOUNT      => $this->price_amount,
            UrlParameter::PRICE_CURRENCY    => $this->price_currency,
            UrlParameter::PERIOD            => $this->period,
        ]));
    }

    /**
     * @param Request $request
     * @return Redirect
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function subscribePaintFest(Request $request) : Redirect
    {
        return redirect($this->flexpay->paintFest()->subscription([
            UrlParameter::NAME              => $this->name,
            UrlParameter::DESCRIPTION       => $this->description,
            UrlParameter::SUBSCRIPTION_TYPE => $this->subscription_type,
            UrlParameter::PRICE_AMOUNT      => $this->price_amount,
            UrlParameter::PRICE_CURRENCY    => $this->price_currency,
            UrlParameter::PERIOD            => $this->period,
        ]));
    }

    /**
     * @param Request $request
     * @return Redirect
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function subscribeGayCharge(Request $request) : Redirect
    {
        return redirect($this->flexpay->gayCharge()->subscription([
            UrlParameter::NAME              => $this->name,
            UrlParameter::DESCRIPTION       => $this->description,
            UrlParameter::SUBSCRIPTION_TYPE => $this->subscription_type,
            UrlParameter::PRICE_AMOUNT      => $this->price_amount,
            UrlParameter::PRICE_CURRENCY    => $this->price_currency,
            UrlParameter::PERIOD            => $this->period,
        ]));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function callback(Request $request) : Response
    {
        try {
            $data = $this->flexpay->callback()->success($request->all());

            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function postback(Request $request) : Response
    {
        try {
            $data = $this->flexpay->postback()->get($request->all());

            return response()->json($data, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_FORBIDDEN);
        }
    }

}
