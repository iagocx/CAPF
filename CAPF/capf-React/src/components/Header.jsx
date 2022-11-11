import React from "react"
import Logo3 from "../imagens/logo03.png"

export default function Header() {
    return (
        <header>
            <nav className="nav">
                <img src= {Logo3} className="nav-logo" />
                <p className="nav-item">
                    RE/MAX
                </p>
            </nav>
        </header>
    )
}
//export default Header