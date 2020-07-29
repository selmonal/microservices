<?php

use Illuminate\Support\Facades\Mail;

class SendSimpleMailTest extends TestCase
{
    /** @test */
    public function sending_simple_mail()
    {
        Mail::fake();

        $this->json('POST', '/v1/send/simple', [
            'to' => 'selmonal@gmail.com',
            'subject' => 'Hello',
            'body' => 'Welcome to our app.'
        ]);

        $this->assertResponseOk();
        Mail::assertSent('selmonal@gmail.com', SimpleMail::class);
    }
}
