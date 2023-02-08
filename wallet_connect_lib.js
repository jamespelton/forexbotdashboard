import SignClient from "@walletconnect/sign-client";
import { Web3Modal } from "@web3modal/standalone";

const web3Modal = new Web3Modal({
  walletConnectVersion: 1, // or 2
  projectId: "66de21812516e1791389bdebf415aced",
  standaloneChains: ["eip155:1"],
});
const signClient = await SignClient.init({ projectId: "66de21812516e1791389bdebf415aced" });

const { uri, approval } = await signClient.connect({
  requiredNamespaces: {
    eip155: {
      methods: ["eth_sign"],
      chains: ["eip155:1"],
      events: ["accountsChanged"],
    },
  },
});

if (uri) {
  web3Modal.openModal({ uri, standaloneChains: ["eip155:1"] });
  await approval();
  web3Modal.closeModal();
}