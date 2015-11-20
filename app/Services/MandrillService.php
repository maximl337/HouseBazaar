<?php

namespace App\Services;

use Mandrill;
use App\MandrillTemplate;
use App\User;
use Bugsnag;
use App\Contracts\Mail;

class MandrillService implements Mail
{
    /**
     * Vendor
     * @var Object
     */
    public $client;

    /**
     * Sender App\User instance
     * @var Object
     */
    protected $sender;

    /**
     * Recipient App\User instance;
     * @var Object
     */
    protected $recipient;

    /**
     * merge variables for template
     * @var array
     */
    protected $mergeVars = [];

    /**
     * Template App\MandrillTemplate instance
     * @var Object
     */
    protected $template;

    /**
     * Mandrill specific required for template
     * @var array
     */
    protected $templateContent;

    /**
     * Message for template
     * @var array
     */
    protected $message;

    /**
     * Event type that invokes email
     * @var str
     */
    protected $event;

    /**
     * Init vendor
     * @param Mandrill $mandrill [description]
     */
    public function __construct(Mandrill $mandrill)
    {
        $this->client = $mandrill;
    }

    /**
     * set sender
     * @param  User   $sender 
     * @return this         
     */
    public function sender(User $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Set recipient
     * @param  User   $recipient 
     * @return this            
     */     
    public function recipient(User $recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function recipientEmail($email)
    {
        $this->recipient = new User();

        $this->recipient->email = $email;

        $this->recipient->first_name = $email;

        return $this;
    }

    /**
     * Set default merge variables that are
     * available to all templates
     */
    public function setDefaultMergeVars()
    {
        $this->mergeVars = [
            [
                'name'    => 'SFNAME',
                'content' => $this->sender->first_name
            ],
            [
                'name' => 'SLNAME',
                'content' => $this->sender->last_name
            ],
            [
                'name' => 'SNAME',
                'content' => $this->sender->first_name . ' ' . $this->sender->last_name
            ],
            [
                'name' => 'RFNAME',
                'content' => isset($this->recipient->first_name) ? $this->recipient->first_name : ""
            ],
            [
                'name' => 'RLNAME',
                'content' => isset($this->recipient->last_name) ? $this->recipient->last_name : ""
            ],
            [
                'name' => 'RNAME',
                'content' => isset($this->recipient->first_name) ? $this->recipient->first_name : "" 
                             . ' ' . 
                             isset($this->recipient->first_name) ? $this->recipient->first_name : ""
            ],
            [
                'name' => 'SIMAGE',
                'content' => isset($this->sender->avatar) ? $this->sender->avatar : env('DEFAULT_AVATAR')
            ],
            [
                'name' => 'RIMAGE',
                'content' => isset($this->recipient->avatar) ? $this->recipient->avatar : env('DEFAULT_AVATAR')
            ],
            [
                'name' => 'SCCLINK',
                'content' => 'https://www.thenetworkingeffect.com/cc/' . $this->sender->permalink
            ],
            [
                'name' => 'SPHOTO',
                'content' => $this->sender->avatar ?: env('DEFAULT_AVATAR')
            ],
            [
                'name' => 'SCOMPANY',
                'content' => $this->sender->business_name
            ]
        ];

        return $this;

    }

    /**
     * add additional merge vars
     * @param str $name    key
     * @param str $content value
     */
    public function addMergeVar($name, $content)
    {

        $this->mergeVars[] = [

            'name'      => $name,
            'content'   => $content
        ];

        return $this;
    }


    /**
     * Event label that sends mail
     * Used to get the template name
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function event($event)
    {

        $this->event = $event;
        
        return $this;
    }

    /**
     * Check if recipient has opted out 
     * @return bool 
     */     
    public function checkIfRecipientIsUnsubbed()
    {
        return $this->recipient->unsubbed_mail()->where('template_id', $this->template->id)->exists();
    }

    /**
     * Set template App\MandrillTemplate
     */
    protected function setTemplate()
    {
        $template = MandrillTemplate::where('label', $this->event)->exists();

        if(!$template) throw new \Exception('Template with that label does not exist');

        $this->template = MandrillTemplate::where('label', $this->event)->first();
    }

    /**
     * Set template content
     * Required for sending template
     * with Mandrill
     */
    protected function setTemplateContent()
    {
        $this->templateContent = [
            [
                'name'    => 'main',
                'content' => 'The Networking Effect'
            ],
            [
                'name' => 'footer',
                'content' => 'Copyright 2014.'
            ]

        ];
                            
    }

    /**
     * Set Message 
     */
    protected function setMessage()
    {

        $this->message = [
                    'html'      => '',
                    'subject'   => '',
                    'from_email' => 'notifications@housemenow.com',
                    'to'    => array(
                                    array (
                                        'email' => $this->recipient->email,
                                        'name' => $this->recipient->name,
                                        'type' => 'to'
                                            )
                                ),
                    'merge_vars' => array(
                                        array(
                                            'rcpt' => $this->recipient->email,
                                            'vars' => $this->mergeVars
                                        )
                                    ),
                    'preserve_recipients' => true,
                    'headers' => array('Reply-To' => 'notifications@housemenow.com'),
                    'track_opens'   =>  true,
                    'track_clicks'  =>  true
        ];
    }

    /**
     * Send Template Mail
     * @return array
     */
    public function sendTemplate()
    {

        $this->setTemplateContent();

        $this->setMessage();

        $this->setTemplate();

        $unsubbed = $this->checkIfRecipientIsUnsubbed();

        if($unsubbed) return false;

        try {
            
            return $this->client
                            ->messages
                            ->sendTemplate($this->template->name, $this->templateContent, $this->message);
            
            
        } catch(\Mandrill_Error $e) {
            
            return 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            
            throw $e;
        }

    }

    public function sendNonTransactional($templateName)
    {

        $this->setTemplateContent();

        $this->setMessage();

        try {
            
            return $this->client
                            ->messages
                            ->sendTemplate($templateName, $this->templateContent, $this->message);
            
            
        } catch(\Mandrill_Error $e) {
            
            return 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();    
            
            throw $e;
        }

    }

    public function send()
    {
        $this->setMessage();

        try {
            
            return $this->client
                            ->messages
                            ->send($this->message);
            
            
        } catch(\Mandrill_Error $e) {
            
            return 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();    
            
            throw $e;
        }
    }

}