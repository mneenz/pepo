import React from "react";
import ReactDOM from "react-dom";
import ProjectsCategoryContent from "./projects-description.js";

var j = jQuery;

//Create a class of the posts
var ProjectsPosts = React.createClass({

  //Define the initial value of post as null:
  getInitialState: function () {
    return {
      posts: null,
    }
  },

  //Trigger the component lifecycle which will create a suitable managed DOM node (instead of just a REACT node)
  componentWillMount(){
    var s = this;
    j.ajax(React_Theme_Resource.getPost + '?categories=6&_embed')
    .done(function(data){s.setState({posts:data});
      var promises = [];
      data.forEach(function(post){
        if(!post["featured_media"] < 1 ){
        var promise = j.ajax(React_Theme_Resource.getMedia + "/" + post["featured_media"]);}
            promises.push(promise);
      })
      promises.forEach(function(promise,i) {
        if(promise) {
          promise.then(function(values){
            if(typeof values == "string"){ s.state.posts[i]["featured_media"]  = {"source_url":values} }
            else{ s.state.posts[i]["featured_media"] = values; }
            s.setState({posts:s.state.posts});
          })
        }
      })
    })
    .fail(function(){
      console.log("FAIL")
    })
  },
  componentDidMount(){},
  selected_post_content(){
    var selection = this.state.posts.filter(function(post){return post["id"] == this.state.selected_post_id}.bind(this))
    return selection[0];
  },
  //render
  render() {
    var projectsPosts = (this.state.posts);

    var classes;
    if (this.props.visible) {
        classes = 'listed-projects moveUp';
    } else {
      classes = 'listed-projects';
    }

    //Check the value of home page inside render method, it will not render anything until you get the response (until ajax has loaded the Home page JSON):
    if(!projectsPosts) return null;

    //return rendered home page
    return (
      <section id="projects" className={classes}>
      <ProjectsCategoryContent />
      {projectsPosts.map(function(post){return <Post post={post} key={post.id} />}.bind(this))}
      </section>
    )
  }
})

var Post = React.createClass({
  render(){
    var post = this.props.post;
    var imageUrl = post["featured_media"]["source_url"];
    var category = post.categories;
    var designCategoryUrl = React_Theme_Resource.images + "/design-installation-icon.svg";
    var maintenanceCategoryUrl = React_Theme_Resource.images + "/maintenance-icon.svg";
    var excerpt = post.excerpt.rendered;

    //Check if the design category isn't in the category array (-1) and return false, otherwise return true
    if (category.indexOf(5) === -1) {var designCategory = false; }
    else { var designCategory = true; }

    //Check if the maintenance category isn't in the category array (-1) and return false, otherwise return true
    if (category.indexOf(7) === -1) {var maintenanceCategory = false; }
    else { var maintenanceCategory = true; }

    return (
      <article className="project">
        <section className="featured-image">
        <a href={post.link} title={post.title.rendered}>{imageUrl ? <img src={post._embedded['wp:featuredmedia'][0].media_details.sizes.thumbnail.source_url} title={post.title.rendered} /> : null}</a>
          {designCategory ? <img src={designCategoryUrl} title="Design Project" className="project-icon" width="30" height="auto" /> : null}
          {maintenanceCategory ? <img src={maintenanceCategoryUrl} title="Maintenance Project" className="project-icon" width="30" height="auto"/> : null}
        </section>
        <a href={post.link}><h3>{post.title.rendered}</h3></a>
        <section className="introduction">
          <p>{excerpt.replace(/(<p[^>]+?>|<p>|<\/p>)/img, "")}
          <a href={post.link} className="read-more">See entire project</a>
          </p>
        </section>
      </article>
    )
  }
})


export default class ListProjects extends React.Component{
  render() {
    return (
      <ProjectsPosts />
    )
  }
}
