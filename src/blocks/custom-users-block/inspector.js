const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import ContentControl from "./controller/ContentControl";
import AvatarSettings from "./controller/AvatarSettings";
import ImageStyle from "./controller/ImageStyle";
import UserName from "./controller/UserName";
import CardStyle from "./controller/CardStyle";

function Inspector(props) {
    const {attributes, changeQuery, imageSizes, userData} = props;

    return (<InspectorControls key="controls">
        <div className="rttpg-panel-control-wrapper">
            <TabPanel className="rttpg-tab-panel" activeClass="active-tab" tabs={[
                {
                    name: "content",
                    title: "Content",
                    className: "rttpg-tab-btn content"
                },
                {
                    name: "styles",
                    title: "Settings / Styles",
                    className: "rttpg-tab-btn settings"
                }
            ]}
            >
                {(tab) => (
                    <div className="rttpg-tab-content">

                        {/* Content Tab*/}
                        {tab.name === "content" && (
                            <>
                                <ContentControl data={props} changeQuery={changeQuery} imageSizes={imageSizes} userData={userData}/>
                            </>
                        )}

                        {/* Style Tab*/}
                        {tab.name === "styles" && (
                            <>
                                <AvatarSettings data={props} changeQuery={changeQuery}/>
                                {/*<ImageStyle data={props} changeQuery={changeQuery}/>*/}
                                {/*<CountStyle data={props} changeQuery={changeQuery}/>*/}
                                {/*<CardStyle data={props} changeQuery={changeQuery}/>*/}
                            </>
                        )}
                    </div>
                )}
            </TabPanel>
        </div>
    </InspectorControls>)
}

export default Inspector;