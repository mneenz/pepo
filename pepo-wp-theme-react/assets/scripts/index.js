import React from "react";
import ReactDOM from "react-dom";
import Header from "./header.js";
import ListProjects from "./projects.js";

var j = jQuery;

//Create a class of the posts
var HomePageContent = React.createClass({

  //Define the initial value of post as null:
  getInitialState: function () {
    return {
      posts: null,
    }
  },

  //Trigger the component lifecycle which will create a suitable managed DOM node (instead of just a REACT node)
  componentWillMount(){
    var state = this;
    j.ajax(React_Theme_Resource.getPage + '/63')
    .done(function(data){state.setState({posts:data})})
    .fail(function(){
      console.log("FAIL")
    })
  },

  //render
  render() {
    var homePageContent = (this.state.posts);

    //Check the value of home page inside render method, it will not render anything until you get the response (until ajax has loaded the Home page JSON):
    if(!homePageContent) return null;

    var acf = homePageContent.acf;

    //return rendered home page
    return (
      <div>
        <section className="headerContent">
          {/* The map() method creates a new array with the results of calling a provided function on every element in the calling array.*/
          /* Render home page title*/}
          <h1 className="introduction" dangerouslySetInnerHTML={{__html: acf.introduction_text}} />
          <IndexCursor scrollTo="process"/>
        </section>

        <article className="process" id="process">
          <section className="process-content">
            <section className="column" dangerouslySetInnerHTML={{__html: acf.first_paragraph}} />
            <section className="column" dangerouslySetInnerHTML={{__html: acf.second_paragraph}} />
            <section className="column" dangerouslySetInnerHTML={{__html: acf.third_paragraph}} />
            <IndexCursor scrollTo="projects"/>
          </section>
        </article>
        <ListProjects />
      </div>
    )
  }
})


//Scroll down cursor
var IndexCursor = React.createClass({
  onClick() {
    var scroll = document.getElementById(this.props.scrollTo);
    scroll.scrollIntoView({behavior: "smooth", block: "start"});
  },

  render() {
    //return rendered home page
    return (
      <div>
        <h4 onClick={this.onClick} className="index-cursor">{this.props.scrollTo}</h4>
      </div>
    )
  }
});



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

ReactDOM.render(<HomePageContent />, document.getElementById('content'));
