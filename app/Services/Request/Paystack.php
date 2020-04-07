<?php


namespace App\Services\Request;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\Services\Request\CurlService;
use Illuminate\Support\Facades\DB;
use App\Bank;

class Paystack
{
    protected $email;
    protected $amount;
    protected $reference;
    protected $callback_url;
    protected $bank_url = "https://api.paystack.co/bank";
    protected $recipient;
    protected $recipient_code;


    public function __construct()
    {
        $this->callback_url = config('calla.paystack.host_url')."/wallet/verify";
    }

     /**
     * Sends transaction data to a gateway and pay the user.
     *
     * @param Request $request
     * @return mixed
     * @throws Throwable
     */
    public function pay($email, $amount, $reference)
    {

        $this->email = $email;
        $this->amount = $amount;
        $this->reference = $reference;
        

        try {

            $response = $this->executePayment();

            // dd($response);

            // DB::commit();
            return $response;

        }

        catch (Exception $exception) {

            throw new RuntimeException(
                "Failed to send payment: {$exception->getMessage()}"
            );


        }
    }

     /**
     * Carry out the payment
     *
     * @param $payment
     * @return mixed
     */
    private function executePayment()
    {
        try {
            return (new CurlService())
                ->addCurlOption('CURLOPT_RETURNTRANSFER', true)
                ->appendRequestHeaders($this->getRequestHeaders())
                ->post($this->getRequestURL(), $this->getRequestData())
                ->asObject();
        } catch (Exception $exception) {
            throw new RuntimeException(
                "Failed to send payment: {$exception->getMessage()}"
            );
        }
    }

    /**
     * Get request headers
     *
     * @return array
     */
    private function getRequestHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.config('calla.paystack.test_secret_key'),

        ];
    }


    /**
     * Get the request URL
     *
     * @return string
     */
    private function getRequestURL(): string
    {
        return sprintf('%s', config('calla.paystack.api_url'));
    }

    /**
     * Build the request body
     *
     *
     * @return false|string
     */
    private function getRequestData()
    {
        return json_encode([
            'email' => $this->email,
            'amount' => $this->amount,
            'reference' => $this->reference,
            'callback_url' => $this->callback_url
        ]);
    }


    public function requery($reference)
    {
        $this->reference = $reference;


        try {

            $response = $this->executeRequery();

            return $response;

        }

        catch (Exception $exception) {

            dd($exception);


        }
    }

     /**
     * Carry out the requery
     *
     * @param $payment
     * @return mixed
     */
    private function executeRequery()
    {
        try {
            return (new CurlService())
                ->addCurlOption('CURLOPT_RETURNTRANSFER', true)
                ->appendRequestHeaders($this->getRequestHeaders())
                ->get($this->getRequeryURL())
                ->asObject();
        } catch (Exception $exception) {
            throw new RuntimeException(
                "Failed to Requery: {$exception->getMessage()}"
            );
        }
    }

    /**
     * Get the requery URL
     *
     * @return string
     */
    private function getRequeryURL(): string
    {
        return sprintf('%s', config('calla.paystack.requery_url').$this->reference);
    }


    public function bankList(){
        try {
            return (new CurlService())
                ->get($this->bank_url)
                ->asObject();
        } catch (Exception $exception) {
            throw new RuntimeException(
                "Failed to Requery: {$exception->getMessage()}"
            );
        }
    }
    public function transferRecipient($recipient, $type)
    {
        $this->recipient = $recipient;
        $this->type = $type;
        try {
            $response = $this->createRecipient();

            if ($response->status === 'false'){
                return $response;
            }

            $this->recipient_code = $response->data->recipient_code;
            $response = $this->executeTransfer();
            // dd($response);
            return $response;

        }
        catch(Exception $e){

        }


    }

    /**
     * Create the transfer recipient
     *
     * @param $payment
     * @return mixed
     */
    private function createRecipient()
    {
        try {
            return (new CurlService())
                ->addCurlOption('CURLOPT_RETURNTRANSFER', true)
                ->appendRequestHeaders($this->getRequestHeaders())
                ->post($this->getCreateRecipientURL(), $this->getCreateRecipientData())
                ->asObject();
        } catch (Exception $exception) {
            throw new RuntimeException(
                "Failed to Requery: {$exception->getMessage()}"
            );
        }
    }


    /**
     * Get the create recipient URL
     *
     * @return string
     */
    private function getCreateRecipientURL(): string
    {
        return sprintf('%s', config('calla.paystack.transfer_recipient_url'));
    }


    /**
     * Build the request body
     *
     *
     * @return false|string
     */
    private function getCreateRecipientData()
    {
        $bank_code  = Bank::getBankCode($this->recipient->bank);
        return json_encode([
            'type' => 'nuban',
            'name' => $this->recipient->last_name.' '.$this->recipient->first_name ,
            'bank_code' => $bank_code,
            'account_number' => $this->recipient->account_number,
            'currency' => 'NGN',
            'description' => $this->type.' on Calla Charm'
        ]);

    }


    /**
     * Create transfer recipient
     *
     * @param $payment
     * @return mixed
     */
    private function executeTransfer()
    {
        try {
            return (new CurlService())
                ->addCurlOption('CURLOPT_RETURNTRANSFER', true)
                ->appendRequestHeaders($this->getRequestHeaders())
                ->post($this->getTransferURL(), $this->getTransferData())
                ->asObject();
        } catch (Exception $exception) {
            throw new RuntimeException(
                "Failed to Requery: {$exception->getMessage()}"
            );
        }
    }


    /**
     * Get the transfer URL
     *
     * @return string
     */
    private function getTransferURL(): string
    {
        return sprintf('%s', config('calla.paystack.transfer_url'));
    }


    /**
     * Build the request body
     *
     *
     * @return false|string
     */
    private function getTransferData()
    {
        $bank_code  = Bank::getBankCode($this->recipient->bank);
        return json_encode([
            'type' => 'nuban',
            'name' => $this->recipient->last_name.' '.$this->recipient->first_name ,
            'bank_code' => $bank_code,
            'account_number' => $this->recipient->account_number,
            'currency' => 'NGN',
            'description' => $this->type.' on Calla Charm'
        ]);

    }



}
