<?php

namespace App\Http\Controllers\mobileweb\blog\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BlogPost;
use App\BlogFile;
use App\BlogTag;
use App\BlogPostTag;
use App\BlogComment;
use App\BlogCategory;
use App\Users;

use Carbon\Carbon;

use Auth;

use DB;

class BlogMainController extends Controller
{
    
    public function indexblog(){



    	$activeMenu = 'blog';

        $headerpage = 'امداد بلاگ';
        
        $taag = BlogTag::select(['blog_tag.*'])->get();

        $blogposts = BlogPost::join('users','blog_post.bp_userid','=','users.id')
            ->select('users.name','blog_post.*')
            ->where('blog_post.BP_DISPLAYSTATUS','=',1)
            ->orderBy('blog_post.CREATED_AT','desc')
            ->with(['tags'])
            ->paginate(5);

        $blogpostcategory = BlogCategory::select(['blog_category.*'])
            ->where('blog_category.bc_subcategoryid','=',0)
            ->where('blog_category.BC_DISPLAYSTATUS','=',1)
            ->withCount('posts')
            ->get();

        foreach ($blogposts as $index => $item){

            $blogposts[$index]['files'] = BlogFile::select(['blog_files.bf_source'])
                ->where('blog_files.bf_idpost','=',$item->id)
                ->get();

            $blogposts[$index]['comments'] = BlogComment::select(['blog_comment.bc_comment'])
                ->where('blog_comment.bc_postid','=',$item->id)
                ->count();

            
        }

    	return view('/blog/users/blog-main')->with([

            'activeMenu' => $activeMenu,

            'headerpage' => $headerpage,

            'blogposts' => $blogposts,

            'blogpostcategory' => $blogpostcategory,

            'taag' => $taag

        ]);

    }


    public function postshow(Request $request,$id,$slug = ''){


        $headerpage = 'امداد بلاگ';

        $idcheck = BlogPost::select('blog_post.id')
            ->where('blog_post.id','=',$id)
            ->where('blog_post.BP_DISPLAYSTATUS','=',1)
            ->count();
        if($idcheck==0){

            $blogpost = BlogPost::select('blog_post.id')
                ->where('blog_post.BP_DISPLAYSTATUS','=',1)
                ->paginate(1);
        
            foreach ($blogpost as $valueid) {
                $id = $valueid->id;
            }
        }
            




        $now = \Carbon\Carbon::now();

        $result = [];

        for($i = 1;$i<=3;$i++){

            $result[] = \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::now()->addDays($i))->format("%Y-%m-%d");

        }

        

        $activeMenu = 'blog';

        $blogpost = BlogPost::join('users','blog_post.bp_userid','=','users.id')
            ->select('users.*','blog_post.*')
            ->where('blog_post.BP_DISPLAYSTATUS','=',1)
            ->where('blog_post.id','=',$id)
            ->with(['tags'])
            ->paginate(1);

             
        foreach ($blogpost as $bp){

            DB::table('blog_post')->where('id', $id)->update(['BP_VIEWED' => $bp->BP_VIEWED + 1]);

        }

        $blogfiles = BlogFile::select(['blog_files.bf_source'])->where('blog_files.bf_idpost','=',$id)->get();

        $blogcomments = BlogComment::join('users','blog_comment.BC_USERID','=','users.id')->select('blog_comment.*','users.*')->where([['blog_comment.bc_postid','=',$id],['blog_comment.BC_ANSWERCOMMENTID','=',0]])->get();



        foreach ($blogcomments as $index => $blogcomment) {
        

            $blogcomments[$index]['answers'] = BlogComment::join('users','blog_comment.BC_USERID','=','users.id')->select('blog_comment.*','users.*')->where('blog_comment.BC_ANSWERCOMMENTID','=',$blogcomment->idcomment)->get();

        }

        $blogviewed = BlogPost::join('blog_files','blog_post.id','=','blog_files.bf_idpost')->where('blog_files.bf_default',true)->select('blog_post.*','blog_files.bf_source')->where('blog_post.BP_VIEWED','>',25)->paginate(8);


        $taag = BlogTag::select(['blog_tag.*'])->get();
         $blogposts = BlogPost::join('users','blog_post.bp_userid','=','users.id')->select('users.name','blog_post.*')->orderBy('blog_post.CREATED_AT','desc')->with(['tags'])->paginate(5);

        $blogpostcategory = BlogCategory::select(['blog_category.*'])->where('blog_category.bc_subcategoryid','=',0)->withCount('posts')->get();

        foreach ($blogposts as $index => $item){

            $blogposts[$index]['files'] = BlogFile::select(['blog_files.bf_source'])->where('blog_files.bf_idpost','=',$item->id)->get();

            $blogposts[$index]['comments'] = BlogComment::select(['blog_comment.bc_comment'])->where('blog_comment.bc_postid','=',$item->id)->count();

            
        }      


        return view('/blog/users/blog-view')->with([

            'activeMenu' => $activeMenu,

            'headerpage' => $headerpage,

            'blogviewed' => $blogviewed,

            'blogpost' => $blogpost,

            'blogfiles' => $blogfiles,

            'blogcomments' => $blogcomments,

            'dates' => $result,

            'blogposts' => $blogposts,

            'blogpostcategory' => $blogpostcategory,

            'taag' => $taag

            

        ]);

    }
/*
            
            */


    public function blogtags(Request $request,$id,$tag = ''){

        $activeMenu = 'blog';

        $posts = BlogPostTag::join('blog_post','blog_post_tag.btc_postid','=','blog_post.id')
            ->join('users','blog_post.bp_userid','=','users.id')
            ->join('blog_files','blog_post.id','=','blog_files.bf_idpost')
            ->where('blog_files.bf_default','=',1)
            ->where('btc_tagid','=',$id)
            ->select('blog_post.*','users.name','users.lastname as user_lastname','users.id as user_id','blog_files.*')
            ->get();
        
        dd($posts);

        

        return view('/blog/users/blog-main')->with([

            'activeMenu' => $activeMenu,

            'blogposts' => $blogposts,

            'blogpostcategory' => $blogpostcategory,

            'taag' => $taag

        ]);
    	
    }



    public function addComment(Request $request){

        $activeMenu = 'blog';

        $checkuserpostinserted = BlogComment::select('blog_comment.id')->where('blog_comment.BC_USERID','=',Auth::user()->id)->where('blog_comment.BC_POSTID','=',$request->get('comment-post'))->count();

       
        if($checkuserpostinserted >= 3){

            $message['message'] = 'شما بیش از حد مجاز در این پست ، نظر ثبت کرده اید .';

            $message['class'] = 'alert-warning';

            return redirect()->back()->with('message',$message);
        }

        $savecomment = new BlogComment();

        $savecomment->BC_USERID = Auth::user()->id;

        $savecomment->BC_POSTID = $request->get('comment-post');

        $savecomment->BC_COMMENT = $request->get('commenttext');

        $savecomment->save();

        return redirect()->back();




    }

    public function addreplycomment(Request $request){

        $checkuserreplycommentiserted = BlogComment::select('blog_comment.idcomment')->where('blog_comment.BC_USERID','=',Auth::user()->id)->where('blog_comment.BC_ANSWERCOMMENTID','=',$request->get('comment-id'))->count();

        if ($checkuserreplycommentiserted >= 3) {


            $message['message'] = 'شما بیش از حد مجاز در این نظر ، پاسخ ثبت کرده اید .';

            $message['class'] = 'alert-warning';

            return redirect()->back()->with('message',$message);

        }


        $savereplycomment = new BlogComment();

        $savereplycomment->BC_COMMENT = $request->get('replycomment');

        $savereplycomment->BC_ANSWERCOMMENTID = $request->get('comment-id');

        $savereplycomment->BC_USERID = Auth::user()->id;

        $savereplycomment->BC_POSTID = $request->get('comment-post');

        $savereplycomment->save();

        return redirect()->back();
    }


    public function blogsearch(Request $request){



        $activeMenu = 'blog';

        $headerpage = 'امداد بلاگ';
        
        $taag = BlogTag::select(['blog_tag.*'])->get();

        $blogposts = BlogPost::join('users','blog_post.bp_userid','=','users.id')
            ->select('users.name','blog_post.*')
            ->where('blog_post.BP_DISPLAYSTATUS','=',1)
            ->where('blog_post.BP_TITLE','like','%'.$request->get('blogsearch').'%')
            ->orderBy('blog_post.CREATED_AT','desc')
            ->with(['tags'])
            ->paginate(5);

        if ($blogposts->isEmpty()){

            $message['message'] = 'بلاگ مورد نظر شما یافت نشد .';

            $message['class'] = 'alert-warning';

            return redirect()->back()->with('message',$message);


        }

        

        $blogpostcategory = BlogCategory::select(['blog_category.*'])->where('blog_category.bc_subcategoryid','=',0)->withCount('posts')->get();

        foreach ($blogposts as $index => $item){

            $blogposts[$index]['files'] = BlogFile::select(['blog_files.bf_source'])->where('blog_files.bf_idpost','=',$item->id)->get();

            $blogposts[$index]['comments'] = BlogComment::select(['blog_comment.bc_comment'])->where('blog_comment.bc_postid','=',$item->id)->count();

            
        }

        return view('/blog/users/blog-main')->with([

            'activeMenu' => $activeMenu,

            'headerpage' => $headerpage,

            'blogposts' => $blogposts,

            'blogpostcategory' => $blogpostcategory,

            'taag' => $taag

        ]);
    }

    public function category(Request $request,$id,$slug = ''){


        $activeMenu = 'blog';

        $headerpage = 'امداد بلاگ';
        
        $taag = BlogTag::select(['blog_tag.*'])->get();

        $blogposts = BlogPost::join('users','blog_post.bp_userid','=','users.id')
        ->select('users.name','blog_post.*')
        ->where('blog_post.BP_CATID','=',$id)
        ->where('blog_post.BP_DISPLAYSTATUS','=',1)
        ->orderBy('blog_post.CREATED_AT','desc')
        ->with(['tags'])
        ->paginate(5);


        if ($blogposts->isEmpty()){

            $message['message'] = 'بلاگی در دسته بندی مورد نظر شما یافت نشد .';

            $message['class'] = 'alert-warning';

            return redirect()->back()->with('message',$message);
        }

        $blogpostcategory = BlogCategory::select(['blog_category.*'])->where('blog_category.bc_subcategoryid','=',0)->withCount('posts')->get();

        foreach ($blogposts as $index => $item){

            $blogposts[$index]['files'] = BlogFile::select(['blog_files.bf_source'])->where('blog_files.bf_idpost','=',$item->id)->get();

            $blogposts[$index]['comments'] = BlogComment::select(['blog_comment.bc_comment'])->where('blog_comment.bc_postid','=',$item->id)->count();

            
        }

        return view('/blog/users/blog-main')->with([

            'activeMenu' => $activeMenu,

            'headerpage' => $headerpage,

            'blogposts' => $blogposts,

            'blogpostcategory' => $blogpostcategory,

            'taag' => $taag

        ]);
    }



}
