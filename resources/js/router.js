import Vue from 'vue';
import Router from 'vue-router';

import home from './components/pages/home.vue';
import register from './components/pages/Register.vue';
import login from './components/pages/Login.vue';
import notFound from './components/pages/notfound.vue';
import play from './components/pages/play.vue';
import bonusRecord from './components/pages/bonusRecord.vue';
import inviteRecord from './components/pages/inviteRecord.vue';
import exchangeRecord from './components/pages/exchangeRecord.vue';
import mine from './components/pages/mine.vue';
import wallet from './components/pages/wallet.vue';
import chat from './components/pages/chat.vue';
import game from './components/pages/game.vue';
import recharge from './components/pages/recharge.vue';
import withdraw from './components/pages/withdraw.vue';
import invite from './components/pages/invite.vue';
import bankcard from './components/pages/bankcard.vue';
import reset from './components/pages/resetpassword.vue';
import user from './components/pages/user.vue';
import resetname from './components/pages/resetname.vue';
import avatar from './components/pages/avatar.vue';
import payment from './components/pages/payment.vue';
import test from './components/pages/test.vue';
import inviteRule from './components/pages/inviteRules.vue';


Vue.use(Router);
const routes = [
    {
        path:'/home',
        component:home
    },
    {
        path:'/register',
        component:register,
    },
    {
        path:'/login',
        component:login,
    },
    {
        path:'/play',
        component:play
    },
    {
        path:'/mine',
        component:mine
    },
    {
        path:'/wallet',
        component:wallet
    },
    {
        path:'/chat',
        component:chat
    },
    {
        path:'/record/game',
        component:game
    },
    {
        path:'/record/recharge',
        component:recharge
    },
    {
        path:'/record/withdraw',
        component:withdraw
    },
    {
        path:'/mine/invite',
        component:invite
    },
    {
        path:'/mine/invite/rules',
        component:inviteRule
    },
    {
        path:'/mine/invite/bonusRecord',
        component:bonusRecord,
    },
    {
        path:'/mine/invite/inviteRecord',
        component:inviteRecord,
        name:"inviteRecord"
    },
    {
        path:'/mine/invite/exchangeRecord',
        component:exchangeRecord,
        name:"exchangeRecord"
    },
    {
        path:'/mine/user/bank',
        component:bankcard
    },
    {
        path:'/mine/user/password',
        component:reset
    },
    {
        path:'/mine/user/',
        component:user
    },
    {
        path:'/mine/user/info/nickname',
        component:resetname
    },
    {
        path:'/mine/user/info/avatar',
        component:avatar
    },
  
    {
        path:'/invite/:id',
        component:register,
        name:"invite"
    },
    {
        path:'/payment',
        component:payment,
        name:"payment"
    },
    {
        path:'/test',
        component:test,
        name:"test"
    },

  
    {
        path:'/:notFound(.*)',
        component:notFound,
    },

];

const router = new Router({
        mode:'history',
        routes
});



export default router;