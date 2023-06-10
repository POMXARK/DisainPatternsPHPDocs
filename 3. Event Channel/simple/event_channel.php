<?php

interface SubscriberInterface
{
    /**
     * Уведомление подписчика
     * @param $data
     *
     * @return mixed
     */
    public function notify($data);
}

interface PublisherInterface
{
    /**
     * Уведомление подписчиков
     *
     * @param $data - Данные которыми уведомляться подписчики
     *
     * @return mixed
     */
    public function publish($data);
}

/**
 * Интерфейс канала событий
 * Связующее звено между подписчиками и издателями
 */
interface EventChannelInterface
{
    /**
     * Издатель уведомляет всех о том, что надо
     * всех кто подписан на тему $topic уведомить данными $data
     *
     * @param $topic
     * @param $data - может быть реализована в виде dto
     *
     * @return mixed
     */
    public function publish($topic, $data);

    /**
     * Подписчик $subscriber подписывается на событие $topic
     *
     * @param                       $topic
     * @param  SubscriberInterface  $subscriber
     *
     * @return mixed
     */
    public function subscribe($topic, SubscriberInterface $subscriber);
}


class Subscriber implements SubscriberInterface
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function notify($data)
    {
        echo "{$this->getName()} оповещен(-a) данными [{$data}]\n";
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class Publisher implements PublisherInterface
{
    private $topic;
    private $eventChannel;

    public function __construct($topic, EventChannelInterface $eventChannel)
    {
        $this->topic = $topic;
        $this->eventChannel = $eventChannel;
    }

    public function publish($data)
    {
        $this->eventChannel->publish($this->topic, $data);
    }
}

class EventChannel implements EventChannelInterface
{
    private $topics = [];
    public function publish($topic, $data)
    {
        if (empty($this->topics[$topic]))
        {
            return;
        }

        foreach ($this->topics[$topic] as $subscriber) {
            $subscriber->notify($data);
        }
    }

    public function subscribe($topic, SubscriberInterface $subscriber)
    {
        $this->topics[$topic][] = $subscriber;
        echo "{$subscriber->getName()} подписан(-а) на [{$topic}]\n";
    }
}

$newsChannel = new EventChannel();

$highgardenGroup = new Publisher('highgarden-news', $newsChannel);

$winterfellNews = new Publisher('winterfell-news', $newsChannel);
$winterfellDaily = new Publisher('winterfell-news', $newsChannel);

$sansa = new Subscriber('Sansa Stark');
$arya = new Subscriber('Arya Stark');
$cersei = new Subscriber('Cersei Lannister');
$snow = new Subscriber('Jon Snow');

$newsChannel->subscribe('highgarden-news', $cersei);
$newsChannel->subscribe('winterfell-news', $sansa);

$newsChannel->subscribe('highgarden-news', $arya);
$newsChannel->subscribe('winterfell-news', $arya);

$newsChannel->subscribe('winterfell-news', $snow);

$highgardenGroup->publish('New highgarden post');
$winterfellNews->publish('New winterfell post');
$winterfellDaily->publish('New alternative winterfell post');