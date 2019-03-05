<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','IndexController@index')->name('index');
// 登录
Route::get('/login','LoginController@login')->name('login');
Route::post('/login','LoginController@dologin')->name('dologin');
// 退出
Route::get('/logout','LoginController@logout')->name('logout');
// 通用
Route::get('/success','CurrencyController@success')->name('success');
Route::get('/fail','CurrencyController@fail')->name('fail');

// 注册
Route::get('/register','RegisterController@register')->name('register');
Route::post('/register','RegisterController@doregister')->name('doregister');
Route::get('/verification','RegisterController@verification')->name('verification');
// 验证码
Route::get('/captcha','CaptchaController@make')->name('captcha');
Route::get('/mobilecode','RegisterController@mobilecode')->name('ajax-mobile-code');
// 首页自动加载
Route::get('/ajax/newblogs','IndexController@ajaxnewblogs')->name('ajax.newblogs');
// 自动加载评论
Route::get('/comment/{blog_id}','CommentController@index')->name('comment.index');

// Redis
Route::get('/redis','TestController@redis')->name('redis');
// 中间件
Route::middleware(['login'])->group(function(){

    // 广场

    Route::get('/blog/{id}','IndexController@blog')->name('blog');
    // 个人主页
    Route::get('/space/{id}','SpaceController@index')->name('space');
    // 密码管理
    Route::get('/modifypwd','PassWordController@modifypwd')->name('modifypwd');
    Route::get('/forgetpwd','PassWordController@forgetpwd')->name('forgetpwd');
    Route::get('/newpwd','PassWordController@newpwd')->name('newpwd');
    // 日志
    Route::get('/myblog','BlogController@myblog')->name('myblog');
    Route::get('/blog/edit/{id}','BlogController@edit')->name('blog.edit');
    Route::post('/blog/edit/{id}','BlogController@doedit')->name('blog.doedit');
    Route::get('/blog/delete/{id}','BlogController@delete')->name('blog.delete');
    // 添加日志
    Route::get('/write','BlogController@write')->name('write');
    Route::post('/write','BlogController@dowrite')->name('dowrite');

    // 信息设置
    Route::get('/face','FaceController@face')->name('face');
    Route::post('/face','FaceController@upface')->name('upface');
    // 消息
    Route::get('/content','MessageController@content')->name('content');
    Route::get('/mymessage','MessageController@mymessage')->name('mymessage');
    Route::get('/send','MessageController@send')->name('send');
    // 顶
    Route::get('/ding/{blog_id}','BlogController@ding')->name('ding');
    // 评论
    Route::post('/comment','CommentController@ajaxdoadd')->name('comment.doadd');

    // 关注
    Route::get('/gz/{user_id}','FriendController@gz')->name('friend.gz');
    // 取消关注
    Route::get('/qxgz/{user_id}','FriendController@qxgz')->name('friend.qxgz');
    // 添加关注
    Route::get('/tjhy/{user_id}','FriendController@tjhy')->name('friend.tjhy');
    // 删除好友
    Route::get('/schy/{user_id}','FriendController@schy')->name('friend.schy');

    // 裁剪图片
    Route::get('/cj','IndexController@cj')->name('cj');
});