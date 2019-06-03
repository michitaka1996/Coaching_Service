#!/bin/sh

cd assets/scss
mkdir   foundation  layout  object  
cd object
mkdir component  project  utility
cd  ../
cd   foundation
touch _base.scss  _reset.scss
cd ../
cd layout
touch  _main.scss  _sidebar.scss
cd ../
cd object
cd component
touch  _button.scss  _grid.scss
cd ../
cd project
touch   _articles.scss   _profile.scss
cd ../
cd utility
touch    _clearfix.scss    _margin.scss    _text.scss
