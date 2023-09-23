<div class="flex flex-col justify-center items-center">
    <p class="text-base mb-4">Hi {{ $mailData['userName'] }},</p>
    <p class="text-lg font-semibold">Unfortunately, the class to be happened on {{ $mailData['date'] }} at {{ $mailData['time'] }} you have booked has been canceled.</p>
    <p>canceled by: {{ $mailData['canceledBy'] }}</p>
    <p>Thank you for your understanding.</p>
    <p>Best regards,</p>
    <p>Team {{ config('app.name') }}</p>
</div>
