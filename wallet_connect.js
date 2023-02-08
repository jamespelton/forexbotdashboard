import WalletConnectProvider from "@walletconnect/web3-provider";

//  Create WalletConnect Provider
const provider = new WalletConnectProvider({
  infuraId: "27e484dcd9e3efcfd25a83a78777cdf1",
});

//  Enable session (triggers QR Code modal)
await provider.enable();

/*
const polygon = new Polygon(window.ethereum);

const tokenId = '<YOUR_NFT_ID>';

polygon.getToken(tokenId).then((token) => {
  // Check if the NFT is present
  if (token) {
    console.log('NFT is present!');
  } else {
    console.log('NFT is not present.');
  }
});
*/