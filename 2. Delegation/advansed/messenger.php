<?php
interface MessengerInterface
{
    /**
     * Установить того кто будет отправлять сообщение
     *
     * @param $value
     *
     * @return MessengerInterface
     */
    public function setSender($value): MessengerInterface;

    /**
     * Установить того кто будет получать сообщение
     *
     * @param $value
     *
     * @return MessengerInterface
     */
    public function setRecipient($value): MessengerInterface;

    /**
     * Установить сообщение
     *
     * @param $value
     *
     * @return MessengerInterface
     */
    public function setMessage($value): MessengerInterface;

    /**
     * Отправить сообщение
     *
     * @return bool
     */
    public function send(): bool;
}

abstract class AbstractMessenger implements MessengerInterface
{
    protected $sender;
    protected $recipient;
    protected $message;

    public function setSender($value): MessengerInterface {
        $this->sender = $value;
        return $this;
    }

    public function setRecipient($value): MessengerInterface {
        $this->recipient = $value;
        return $this;
    }

    public function setMessage($value): MessengerInterface {
        $this->message = $value;
        return $this;
    }

    public function send(): bool {
        return true;
    }
}

class EmailMessenger extends AbstractMessenger
{
    public function send(): bool
    {
        echo 'send by ' .__METHOD__;
        echo "\n";
        return parent::send();
    }
}

class SmsMessenger extends AbstractMessenger
{
    public function send(): bool
    {
        echo 'send by ' .__METHOD__;
        echo "\n";
        return parent::send();
    }
}

class AppMessenger implements MessengerInterface
{
    private $messenger;

    public function __construct()
    {
        $this->toEmail();
    }

    public function setSender($value): MessengerInterface
    {
        $this->messenger->setSender($value);
        return $this;
    }

    public function setRecipient($value): MessengerInterface
    {
        $this->messenger->setRecipient($value);
        return $this;
    }

    public function setMessage($value): MessengerInterface
    {
        $this->messenger->setMessage($value);
        return $this;
    }

    public function send(): bool
    {
        return $this->messenger->send();
    }

    /**
     * Использование функционала для отправки по email
     *
     * @return $this
     */
    public function toEmail()
    {
        $this->messenger = new EmailMessenger();
        return $this;
    }

    /**
     * Использование функционала для отправки по sms
     *
     * @return $this
     */
    public function toSms()
    {
        $this->messenger = new SmsMessenger();
        return $this;
    }
}

// Пример переключения обработчика в реальном времени (декларативный стиль)
$item = new AppMessenger();

$item->setSender('sender@inet.net')
     ->setRecipient('recipient@mmail.com')
     ->setMessage('Hello email messenger!')
     ->send();

$item->toSms()
     ->setSender('1111111')
     ->setRecipient('22222')
     ->setMessage('Hello SMS messenger!')
     ->send();