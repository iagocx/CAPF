import React from "react"
export default function MainContent() {
    return (
        <div className="main-div">
        <h1> Acesse sua conta </h1>
		<form action="" method="POST">
			<p>  
				<label> E-mail </label>
				<input type="text" name="email" required></input>
			</p>
			<p>  
				<label> Senha </label>
				<input type="password" name="senha" required></input>
			</p>
			<p>  
				<button type="submit"> Entrar </button>
			</p>
		</form>
            
        </div>
    )
}