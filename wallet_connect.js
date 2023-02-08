import ERC721 from 'ERC721.json'

const contract_address = '0x9becFB7B753AfE1450Dc7dB21CDd8fA4cCDAE81C';


let btn = document.querySelector('#show');
btn.addEventListener('click', function () {
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
         


      }
    });

     console.log(`Wallet: ${walletAddress}`);

  
  } else {
   console.log("No wallet");
  }
}

async holdsToken(contractAddress) {
  const ERC721 = require()
  const provider = await web3Modal.connect() /* This example uses the web3Modal package */
  const web3 = new Web3(provider)
  const accounts = await web3.eth.getAccounts()
  const currentWallet = Web3.utils.toChecksumAddress(accounts[0])

  const contract = new web3.eth.Contract(ERC721.abi, contractAddress)

  const result = await contract.methods.balanceOf(currentWallet).call()
  console.log(result);

  return parseInt(result) && parseInt(result) > 0
}