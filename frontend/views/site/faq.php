<?php

//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\Accordion;

$memberDetails=Yii::$app->memberdetails;
$oppotunityLink = Url::to(['/training/default/index']);
$this->title = 'FAQ';

$this->params['breadcrumbs'][] = $this->title;
!empty($refmodel->sponsor) ? $this->params['breadcrumbs'][] = "Your Referrer: " . $refmodel->memberName . " - Member No: " . $refmodel->sponsor : '';
?>
<div class="site-faq">
    <div class="row">
        <h1>Frequently Asked Questions(FAQ)</h1>
        <p>
            <?=
            Accordion::widget(['items' =>
                [
                    ['header' => 'What is Knowledgetoearn.com about?',
                        'content' => '<p>This is an online training platform which offers motivational and inspirational training packages to help members better their lives.</p>
                            <p>The training modules contain content which is not normally taught in formal educational institutions, but will bridge the gap between school and life skills to add value to an individuals growth in all aspects of life. This includes Personal and Economic development.</p>',
                    ],
                    [
                        'header' => 'What is a Business center?',
                        'content' => '<p>This is where you are positioned within the genealogy organization of knowledgetoearn.com system.</p>',
                    ],
                    [
                        'header' => 'Can I have more than one account?',
                        'content' => '<p>This being a training platform, we don’t allow a person to have multiple business centres. But a member can open business centres for family members who they feel that they want to help in gaining the knowledge offered. </p>',
                    ],
                    [
                        'header' => 'What membership packages are there?',
                        'content' => '<p>To join platform, you choose from one of two membership packages, Gold (25$) or Diamond (50$)</p>
                    <p>A Diamond package has more training areas and also has higher earning potential. (Refer to opportunity tab.)</p>
                    <p>You can always upgrade from Gold to Diamond at any time by paying the difference of 25$</p>',
                    ],
                    [
                        'header' => 'How can I earn from the Affiliate Program?',
                        'content' => '<p>There are five ways to earn namely:-
                      <ol type="1">
                      <li>Sponspoship or Referral Bonus - Each time you introduce/refer (sponsor) a new member and they become members you recieve a percentage payment depending on your package and the packgae the new member has  joined with. you also accumulate Points (PV)that contribute to your Ranking also commensurate with the packages</li>
                      <li>Team or Binary Bonus - Once you have a sponsored member on the Left and right you qualify for this bonus. Immediately you have 10PV on left and on the right forming a cycle you immediately recieve $'.$memberDetails->getAppConstant('amountEarnedPerCycle').'  </li>
                      <li>Matching Bonus - Get paid 5-10 %of what your team members earn from Binary bonus</li>
                      <li>Rank Advancement - Paid once a month, for those who have reached certain sponsoring thresholds</li>
                      <li>Promotional Bonus - Occur periodically to enhance membership</li> </ol>
                      
                      For more details check the <a href="' . $oppotunityLink . '">Opportunity Presentation</a></p>',
                    ],
                    [
                        'header' => 'What are the payment options?',
                        'content' => '<p>To pay for your membership package, you have three options: Bitcoins, Gift Codes and iPay platform that allows mobile money transfer and use of credit/ debit cards</p>',
                    ],
                    [
                        'header' => 'What are the withdrawal options?',
                        'content' => '<p>The minimum withdrawal is 25$ and can be withdrawn any day from 7AM to 7PM through;</p>'
                        . '<ul type="square">
                            <li>Gift Code</li>
                            <li>Bitcoins</li>
                            <li>iPay - this allows transfer to mobile phone money transfer and direct to your bank account. </li>
                        </ul>',
                    ],
                    [
                        'header' => 'When does Rank Advancement month start?',
                        'content' => '<p>The rank advancement month starts on the 1st day of every month.</p>',
                    ],
                    [
                        'header' => 'What is meant by the Points Value (PV)?',
                        'content' => '<p>Every Gold membership contributes 10 PV to thier sponsor, while Diamond Membership contributes 20 PV to thier sponsor, at the time of joining.</p>
                                <p>Every upgrade package earns the upgrader\'s sponsor 10 PV.</p>',
                    ],
                    /* [
                      'header'=>'>What is meant by \'Active\' membership status?',
                      'content'=>'<p>To be active means that you have paid your monthly subscription. You need to be active every month by paying 5$ at your due date, meaning if you join on 10th of a particular month, you need to pay monthly subscriptions at the same date every month.</p>',
                      ], */
                    [
                        'header' => 'What is a Cycle?',
                        'content' => '<p>When you accumulate 10 PV on the Left and 10 PV on the Right, You will have completed a cycle which is paid $'.Yii::$app->memberdetails->getAppConstant("amountEarnedPerCycle").'. </p>',
                    ],
                    [    'header' => 'How do I qualify for a cycle?',
                        'content' => '<p>Cycle points begin to accumulate once you have one directly sponsored/referred member on the right and another directly sponsored/referred member on the left. Consequently, when any new enrollment, falls under your business centre amounting to 10 ponts on left and  another 10 points on the right a cycle is achieved. This is regardless of the depth(level) that the enrollment occurs or who enrolled the new entrant.</p>',
                    ],
                    [
                        'header' => 'Do Points accumulate?',
                        'content' => '<p>Yes, Points in Knowledgetoearn.com system accumulate so long as you are a member. These contribute to your ranking.</p>',
                    ],
                ],])
            ?>

        </p>
    </div>
</div>
