import ERC721 from 'ERC721.json'


let btn = document.querySelector('#show');
btn.addEventListener('click', function () {
    console.log("Clicked");
    connect();
});


/* To connect using MetaMask */
async function connect() {
  if (window.ethereum) {
     await window.ethereum.request({ method: "eth_requestAccounts" });
     window.web3 = new Web3(window.ethereum);
     const account = web3.eth.accounts;
     //Get the current MetaMask selected/active wallet
     const walletAddress = account.givenProvider.selectedAddress;
     //Eth = chainID 1
     //Polygon = chainID 137
     //BSC = chainID 56
     
     //Verify we are on the right chain
     web3.eth.getChainId().then(chainId => {
      if (chainId !== 56) {
        console.log("Must be on BSC to continue!");
      } else {
         //Check how many NFTs they have
         contract_address = '0x9becFB7B753AfE1450Dc7dB21CDd8fA4cCDAE81C';


      }
    });

     console.log(`Wallet: ${walletAddress}`);

  
  } else {
   console.log("No wallet");
  }
}