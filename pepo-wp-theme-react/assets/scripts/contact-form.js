import React from "react";
import ReactDOM from "react-dom";

var j = jQuery;

var ContactFormContent = React.createClass({

  //Define the initial value of post as null:
  getInitialState: function () {
    return {
      posts: null,
    }
  },

  //Trigger the component lifecycle which will create a suitable managed DOM node (instead of just a REACT node)
  componentWillMount(){
    var state = this;
    j.ajax(React_Theme_Resource.getPage + '/93')
    .done(function(data){state.setState({posts:data})})
    .fail(function(){
      console.log("FAIL")
    })
  },

  //render
  render() {
    var contactPageContent = (this.state.posts);

    //Check the value of home page inside render method, it will not render anything until you get the response (until ajax has loaded the Home page JSON):
    if(!contactPageContent) return null;

    var content = contactPageContent.content;
    var acf = contactPageContent.acf;

    var email = "mailto:" + acf.email;
    var phone = "tel:" + acf.phone_number;

    //return rendered home page
    return (
      <div>
        <div dangerouslySetInnerHTML={{__html: content.rendered}} />
        <ul className="contact-info">
          <li className="address" dangerouslySetInnerHTML={{__html: acf.address}}/>
          <li><a className="phone" href={phone}>{acf.phone_number}</a></li>
        </ul>
      </div>
    )
  }
});

export default class ContactForm extends React.Component {

  render() {
    return (
      <ContactFormContent />
    )
  }
}
