import React from "react"
import ReactDOM from "react-dom/client"
import Header from "./components/Header.jsx"
import Footer from "./components/Footer.jsx"
import MainContent from "./components/MainContent.jsx"

function App() {
    return (
        <div className="ret">
            <Header />
            <MainContent />
            <Footer />
        </div>
    )
}

//ReactDOM.render(<App />, document.getElementById("root"))

ReactDOM.createRoot(document.getElementById("root")).render(  
    <React.StrictMode>
        <App />
    </React.StrictMode>
)
