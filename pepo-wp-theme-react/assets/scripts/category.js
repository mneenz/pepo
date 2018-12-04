import React from "react";
import ReactDOM from "react-dom";
import Header from "./header.js";
import ListProjects from "./projects.js";

var j = jQuery;

//Create a class of the posts
var CategoryContent = React.createClass({



  //render
  render() {


    //return rendered home page
    return (
      <div>
        <ListProjects />
      </div>
    )
  }
})




{/*Possible 'have some questions on our services?' link clicks to change state class of contact form
class ContactLinks extends React.Component{

 constructor(props) {
    super(props);
    this.handleLoad = this.handleLoad.bind(this);
 }

 componentDidMount() {
    window.addEventListener('load', this.handleLoad);
 }

 handleLoad() {
      jQuery(".closed").attr('class', 'open');

  }

  var ContactLink = document.getElementById('#contact-link');

  render (){
    return (
      <ContactLink onClick={this.handleLoad}>
    )
  }

}*/}

ReactDOM.render(<CategoryContent />, document.getElementById('content'));
