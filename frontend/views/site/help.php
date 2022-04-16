<?php

//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\Accordion;

$memberDetails=Yii::$app->memberdetails;
$oppotunityLink = Url::to(['/training/default/index']);
$this->title = 'Help';

$this->params['breadcrumbs'][] = $this->title;
!empty($refmodel->sponsor) ? $this->params['breadcrumbs'][] = "Your Referrer: " . $refmodel->memberName . " - Member No: " . $refmodel->sponsor : '';
?>
<div class="site-faq">
    <div class="row">
        <h1><?= $this->title ?></h1>
        <p>
            <?=
            Accordion::widget(['items' =>
                [
                    ['header' => 'How to use the Dashboard',
                        'content' => '<p>On successful log in, the application directs the user to the dashboard that appears as in diagram below.</p> '
                        . '<p><img src="images/help/dashboard1.jpg" class="img-responsive"></p>'
                        . '<p>The Dashboard gives a summary of the member\'s current status. '
                        . '<ul type="square">
                            <li>On the left the members particulars and the sponsors name.</li>
                            <li>In the middle (white section), the bonuses pending and achieved</li>
                            <li>On the right the Marketing Link. One needs to change the radio button selector to fill the Link area.</li>
                            </ul>
                         </p>',
                    ],
                    [
                        'header' => 'How to use the Genealogy tree',
                        'content' => '<p>The Genealogy tree shows a pictorial view of all the members that are in your Team whether sponsored by you, or by your uplines (Sponsor and above), or by your Team member\'s.</p>'
                                    . '<p>A typical Genealogy tree is as follows</p><p><img src="images/help/genealogyTree1.jpg" class="img-responsive">'
                                    . 'The features of the tree are:- </p>'
                                    . '<ul type="square">
                                            <li>The tree shows only six binary levels at a time. By clicking on any image, that image of the member clicked on moves to the top  and you may now view up to five levels below that.   </li>
                                            <li>To pan horizontally, a scrollbar is provided at the bottom of the diagram.</li>
                                            <li><p>To place a prospect below a specific team member, click on the member\'s number to reveal a popup. indicating the sponsor and the member that you wish to place your prospect under.</p>
                                                <p>Ensure the sponsor number is the correct one. If not change it</p>
                                                <p>Select the \'Position\' radio button to fill the Marketing  Link. Highlight and copy (CNTRL + C)the link</p></li>
                                            <li>To reset the Genealogy Tree, click on the \'Back to Top\' Button on the right side in the action column</li>
                                            <li>One may also search for a member using the search field in the action Text box on the Right</li>
                                            <li></li>
                                        </ul>
                                            ',
                    ],
                    [
                        'header' => 'The \'My Team\' Menu Option',
                        'content' => '<p> This gives a list of all members sponsored by the current user.</p>',
                    ],
                    [
                        'header' => 'What does the Volume History option represent',
                        'content' => '<p>Once a member has sponsored/referred one member on both the left and on the right, they become elligible to '
                        . '<ul type="square">
                            <li>Accumulate points that contribute to their ranking</li>
                            <li>Begin building a Team</li>
                            </ul>
                            .</p>
                            <p>The volume on Left and right is what is used to calculate the Ranking once amonth.</p>',
                        
                    ],
                    [                        'header' => 'The Finance/Commissions Option',

                        'header' => 'The Finance/Commissions Option',
                        'content' => '<p>This option shows:
                                <ul type="square">
                                    <li>Details of the bonuses earned on seperate tabs</li>
                                    <li>Ability to carry out actions of moving the commissions to the wallet one at a time in the Action column on the right. The Totals pending for each Bonus is also indicated on the right column.</li>
                                </ul>
                                The page appears as follows:-
`       `                   </p>
                            <p><img src="images/help/commissions.jpg" class="img-responsive"></p>
                            ',
                    ],
                    [
                        'header' => 'The Finance/Wallet Option',
                        'content' => 'Wallet
                            <p>Any bonuses (in $) are sent to the wallet from the commissions.</p>
                            <p>The wallet appears as follows:-</p>
                            <p><img src="images/help/walletExample1.jpg" class="img-responsive"></p>
                            <p>The Wallet gives a list of all transactios, both incomming (trxDir=1) and outgoing(trxDir= -1), that have been carried out on the member\'s account in descending date oder (i.e. latest first).</p></li>
                            <p>In the Action column on the right is the following:-
                            <ul type="square">
                                <li>The Wallet current balance is displayed in Red</li>
                                <li>The \'Generate Gift Code\' button 
                                <p>opens the Gift Code Page where, if there is enough funds available($25 and above), a member may generate a gift code of $25 or $50. This generated number shall allow a new member to enroll when used as the \'Transaction No\'.</p>
                                <p>When a Gift code is generated funds are withdrawn from thw wallet . No commission is levied. If not used within seven (7) days, it will be cancelled and funds restored to the wallet. </p>
                                </li>
                                <li>The \'Transfer Funds\' button.
                                    <p>Clicking this button opens the Transfer Funds Page showing all transactions previously executed.</p>
                                    <p>The top section allows a member to indicate the amount to send from their wallet to another members wallet by indicating that member\'s Membership Number. </p>
                                    <p>This is ideal where, by local arrangement, members may help prospects join by helping a sponsor gather enough funds to generate a Gift Code.</p>
                                    <p>Note: The transfer attracts a 5% transfer charge</p>
                                </li>
                                <li>The \'Receive Funds\' button
                                <p>This button only becomes active when another member has sent funds i.e.. there are funds available for you. </p>
                                <p>On clicking this button, the funds are transfered to your wallet and the balance increases by the amount transferred.</p>
                                
                                </li>
                                </ul>
                                ',
                    ],
                    [
                        'header'=>'Funds Withdrawal',
                        'content' => '<ul type="square">
                                <li>Withdraw Funds Button
                                <p>This button remains deactivated until the balance is $25 and over</p>
                                <p>On opening a form like the following appears <img src="images/help/fundsWithdrawalExample1.jpg" class="img-responsive"></p>
                                <p>The form requires the member to provide:-
                                    <ul type="circle">
                                    <li>Which Payment Gateway to send funds to. As at the time of writing this, CoinPayments wallet, blockchain Wallet, and Paypal were available. Select one of these</li>
                                    <li>Indicate the Account Number belonging to the member at that Payment Gateway.</li>
                                    <li>Indicate the amount ($) to be withdrawn.</li>
                                    </ul>
                                 Click on \'Request\' button to complete the transaction.   
                                </p>
                                <p>The transaction is effected within 24 hours.</p>
                                <p>Note: The Witdrawal attracts a 5% withdrawal charge</p>
                                </li>
                                <li>View Withdrawal Details Button
                                <p>This button takes the user to a Withdrawals List Page. The page appears as follows:-</p>
                                <p><img src="images/help/withdrawalListExample1.jpg" class="img-responsive"></p>
                                <p>All withdrawals ever made, starting with the latest, and their status and amount are shown on these pages.</p>
                                </ul>',
                    ],
                ],])
            ?>

        </p>
    </div>
</div>
