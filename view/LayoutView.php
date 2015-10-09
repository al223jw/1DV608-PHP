<?php

class LayoutView {
  public function render($isLoggedIn, $v, DateTimeView $dtv, RegisterView $rv) {
    $html = '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">' . $this->decideView($v, $rv)  . $dtv->Show() . '
          </div>
        </body>
      </html>
    ';
    echo $html;
  }
  
  public function decideView($v, $rv) {
    if(isset($_GET["register"]))
    {
      return $rv->RegisterLayout();
      
    }
    else {
      return $v->response();
    }
  }
  
  private function renderIsLoggedIn($isLoggedIn)
  {
    if ($isLoggedIn)
    {
      return '<h2>Logged in</h2>';
    }
    else 
    {
      return $this->renderOption() . '<br/><h2>Not logged in</h2>';
    }
  }
  
  private function renderOption()
  {
    if(isset($_GET["register"]))
    {
      return '<a href=?>Back to login</a>';
    }
    else
    {
      return '<a href=?register>Register a new user</a>';
    }
  }
}