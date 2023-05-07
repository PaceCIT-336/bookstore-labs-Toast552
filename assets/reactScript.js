class Header extends React.Component {
    render() {
        return (<header><h1><a href="index.php">Rainy Bookstore</a></h1></header>);
    }
}

class UserDetails extends React.Component {
    // a subcomponent of UserPage
    // displays user details
    render() {
        return (
            <div>
                <h2>Personal Details</h2>
                {/* print the user details from the props here */}
                
            </div>
        );
    }
}

class UserPage extends React.Component {
    // a wrapper component made up of header, user details, and user purchases subcomponents
    render() {
        return (
            <>
                <Header />
                <div className="container">
                    <UserDetails 
                        firstName={this.props.firstName} 
                        lastName={this.props.lastName} 
                        address={this.props.address}
                        email={this.props.email}
                        phone={this.props.phone}
                    />
                 </div>
            </>
        );
    }
}


function doRender(element, target) {
    ReactDOM.render(element, document.getElementById(target));
}