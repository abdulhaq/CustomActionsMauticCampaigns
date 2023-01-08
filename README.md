
# Add Custom Actions to Mautic Campaign Builder

Recently while working for a client I developed a Mautic plugin to add custom action on Campagin builder.

Your actions will show up in campagin bulder. You can also create new conditions or decisions which gives you complete control over your customer's journy.

## Code explained

#### How to add custom action to campaign

```php
public function onCampaignBuild(CampaignBuilderEvent $event)
    {
        $event->addAction(
            'sos.campaign.mark_success',
            [
                'label'           => 'Mark as Success',
                'eventName'       => CampaignStatsEvents::ON_CAMPAIGN_MARK_SUCCESS, 
                'description'     => 'Mark campaign as success for this contact',

            ]
        );
    }
```

#### Add buttons to drop down menu

```php
$buttons = [
            [
                'label'        => 'View Stats',
                'icon'         => 'fa fa-line-chart',
                'context'      => 'campaign',
            ],
        ];

foreach ($buttons as $button) {
    $this->addButtonGenerator(
        $button['objectAction'], 
        $button['label'], 
        $button['icon'], 
        $button['context']
    );
}
```

## Screenshots
Your actions will show up in campagin bulder. You can also create new conditions or decisions which gives you complete control over your customer's journy.

![App Screenshot](https://raw.githubusercontent.com/abdulhaq/CustomActionsMauticCampaigns/master/img/img-1.png)

How the campagin tree may look like:

![App Screenshot](https://raw.githubusercontent.com/abdulhaq/CustomActionsMauticCampaigns/master/img/img-2.png)

And when the action is triggered, it will show in your customer's profile activity.

![App Screenshot](https://raw.githubusercontent.com/abdulhaq/CustomActionsMauticCampaigns/master/img/img-3.png)


## Tech Stack

**Server:** PHP Symphony


## 🚀 About Me
I'm a full stack developer with experties in Mautic, Laravel, WordPress, AWS, React


## 🔗 Links
[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://it.haq.life/)

[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/abdulhaq0)

[![twitter](https://img.shields.io/badge/twitter-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white)](https://twitter.com/AbdulHaqLife)

