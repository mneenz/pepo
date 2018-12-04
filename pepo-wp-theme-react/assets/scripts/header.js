import React from "react";
import ReactDOM from "react-dom";
import ContactForm from "./contact-form.js";

var j = jQuery;

var Menu = React.createClass({
  getInitialState(){return {menus:[]};},
  componentWillMount(){
    var promises = [],s = this;
    let promise = j.ajax(React_Theme_Resource.getMenu)
    .then(function(data){
      data.forEach(function(menu){promises.push(j.ajax(menu.meta.links.self));})
      promises.forEach(function(promise){
        promise.then(function(data,i){
          s.state.menus.push(data);
          s.setState({menus:s.state.menus});
        })
      })
    })
    .fail(function(reason){
      console.log(reason)
    })
  },

  render(){
    var main_menu = ((this.state.menus).filter(function(menu){return menu.name == "Main"}))[0];
    //console.log(main_menu)

    return (
      <div>
      {main_menu ? <Main_Navigation menu={main_menu}/> :null}
      </div>
    )
  }
})

var Main_Navigation = React.createClass({
  render(){

    return (
      <ul className="mainNav">
        {this.props.menu.items.map(item => {
          return (
            <li key={item.id} className="menu-item"><a className={item.classes} href={item.url}>{item.title}</a></li>
          )
        })
      }
      </ul>
    )
  }
})

var SearchBar = React.createClass({
  render(){
    return (
      <form className="searchspace">
        <div className="input-field">
          <input id="search" type="search" required/>
          <label for="search"><i className="material-icons">search</i></label>
          <i className="material-icons">close</i>
        </div>
      </form>
    )
  }
})

var SocialMediaIcons = React.createClass({
  render(){
    return (
      <section className="social-media-icons">
        <a href="#" title="Pepo Instagram"><img src="/wp-content/themes/pepo-wp-theme/assets/images/instagram-icon.svg" alt="Pepo Instagram" width="25px" height="auto"/></a>
        <a href="#" title="Pepo Pinterest"><img src="/wp-content/themes/pepo-wp-theme/assets/images/pinterest-icon.svg" alt="Pepo Pinterest" width="25px" height="auto"/></a>
        <a href="#" title="Pepo Facebook"><img src="/wp-content/themes/pepo-wp-theme/assets/images/facebook-icon.svg" alt="Pepo Facebook" width="25px" height="auto"/></a>
      </section>
    )
  }
})

class Header extends React.Component{
  constructor(props) {
    super(props);
    this.state = { hidden: 'closed' };
    this.handleClick = this.handleClick.bind(this)
  }

  handleClick() {
    this.setState({ hidden: this.state.hidden == 'open' ? 'closed' : 'open' });
  }

  render() {
    return (
      <div className={this.state.hidden}>
        <div id="header_space">
          <a href="#" aria-haspopup="true" tabindex="0" className="menu_btn slicknav_btn" onClick={this.handleClick}>
            <span className="menu_icon slicknav">
              <span className="menu_icon-bar"></span>
              <span className="menu_icon-bar"></span>
              <span className="menu_icon-bar"></span>
            </span>
           </a>
           <div id="branding">
             <img src={React_Theme_Resource.getLogo} alt="Logo" width="100%" height="auto"/>
           </div>
           <Menu />
           <SocialMediaIcons />
           <SearchBar />
        </div>
        <section id="contact-form" className={this.state.hidden}>
          <h4 onClick={this.handleClick}>Contact</h4>
          <section id="contact-content">
            <ContactForm />
          </section>
        </section>
      </div>
    )
  }
}

ReactDOM.render(<Header/>,document.getElementById("header"));
