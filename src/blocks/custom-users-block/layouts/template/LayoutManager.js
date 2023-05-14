import Layout1 from "./Layout1";
import Layout2 from "./Layout2";

function LayoutManager({attributes, post}) {
    const {layout} = attributes;
    let layoutEl = <Layout1 attributes={attributes} post={post}/>;

    if('layout2' === layout){
        layoutEl = <Layout2 attributes={attributes} post={post}/>;
    }
    return layoutEl;
}

export default LayoutManager;