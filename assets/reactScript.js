class Header extends React.Component {
    render() {
        return (
            <header>
                <h1><a href="index.php">Rainy Bookstore</a></h1>
            </header>
        );
    }
}

class UserDetails extends React.Component {
    // a subcomponent of UserPage
    // displays user details
    render() {
        return (
            <div>
                <h2>Personal Details</h2>
                <p>First Name: {this.props.firstName}</p>
                <p>Last Name: {this.props.lastName}</p>
                <p>Address: {this.props.address}</p>
                <p>Email: {this.props.email}</p>
                <p>Phone: {this.props.phone}</p>
            </div>
        );
    }
}

function UserPurchases(props) {
    return (
        <div>
            <h2>Purchase History</h2>
            {props.purchases.map((purchase, index) => (
                <div key={index}>
                    <p>Title: {purchase.Title}</p>
                    <p>Purchase Date: {purchase.OrderDate}</p>
                </div>
            ))}
        </div>
    );
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
                    <UserPurchases purchases={this.props.purchases} />
                </div>
            </>
        );
    }
}

function doRender(element, target) {
    ReactDOM.render(element, document.getElementById(target));
}

ReactDOM.render(
    <UserPage 
        firstName={firstName} 
        lastName={lastName} 
        address={address} 
        email={email} 
        phone={phone} 
        purchases={JSON.parse(purchases)} 
    />,
    document.getElementById('user')
);
