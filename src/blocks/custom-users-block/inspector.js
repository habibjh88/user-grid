const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import ContentControl from "./controller/ContentControl";
import AvatarSettings from "./controller/AvatarSettings";
import UserName from "./controller/UserName";
import UserBio from "./controller/UserBio";

function Inspector(props) {
    const {attributes, changeQuery, userData} = props;

    //All attribute
    const {
        avatar_visibility,
        name_visibility
    } = attributes;


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
                                <ContentControl data={props} changeQuery={changeQuery} userData={userData}/>
                            </>
                        )}

                        {/* Style Tab*/}
                        {tab.name === "styles" && (
                            <>
                                {avatar_visibility && <AvatarSettings data={props} changeQuery={changeQuery}/>}
                                {name_visibility && <UserName data={props} changeQuery={changeQuery}/>}
                                <UserBio data={props} changeQuery={changeQuery}/>
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