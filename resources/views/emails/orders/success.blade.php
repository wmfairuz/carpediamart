@component('mail::message')
# Order Successful

We are happy to inform you that your order {{ $payment->bill_id }} is successful. Your order will be processed by our team as soon as possible.

Thank you for trusting us and we look forward for your next order on Carpedia Mart!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
