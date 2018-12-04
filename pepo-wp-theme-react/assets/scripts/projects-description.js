import React from "react";
import ReactDOM from "react-dom";

var j = jQuery;

//Create a class of the category
var ProjectsCategory = React.createClass({

  //Define the initial value of post as null:
  getInitialState: function () {
    return {
      projectsCategory: null,
    }
  },

  //Trigger the component lifecycle which will create a suitable managed DOM node (instead of just a REACT node)
  componentWillMount(){
    var state = this;
    j.ajax(React_Theme_Resource.getCategories + '/6')
    .done(function(data){state.setState({projectsCategory:data})})
    .fail(function(){
      console.log("FAIL")
    })
  },

  //render
  render() {
    var projectsCategoryContent = (this.state.projectsCategory);

    //Check the value of home page inside render method, it will not render anything until you get the response (until ajax has loaded the Home page JSON):
    if(!projectsCategoryContent) return null;

    //return rendered home page
    return (
      <article className="projects-category">
        <h2>{projectsCategoryContent.name}</h2>
        <section className="introduction">
          <p className="precede">{projectsCategoryContent.description.replace(/(<p[^>]+?>|<p>|<\/p>)/img, "")}</p>
        </section>
      </article>
    )
  }
})

export default class ProjectsCategoryContent extends React.Component{
  render() {
    return (
      <ProjectsCategory />
    )
  }
}
