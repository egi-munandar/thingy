import React, { Fragment, useEffect, useState } from "react";
import { useSelector, useDispatch } from "react-redux";

import {
    CAvatar,
    CDropdown,
    CDropdownHeader,
    CDropdownItem,
    CDropdownMenu,
    CDropdownToggle,
    CImage,
    CSidebar,
    CSidebarBrand,
    CSidebarNav,
    CSidebarToggler,
} from "@coreui/react";

import { AppSidebarNav } from "./AppSidebarNav";

import SimpleBar from "simplebar-react";
import "simplebar/dist/simplebar.min.css";
import { toggleSidebar, toggleUnfoldable } from "../redux/themeSlice";

// sidebar nav config
import navigation from "./_nav";
import { can } from "../constants/helper";
import { useNavigate } from "react-router-dom";

const AppSidebar = () => {
    const auth = useSelector((s) => s.auth);
    const dispatch = useDispatch();
    const [navItems, setNavItems] = useState([]);
    const unfoldable = useSelector((state) => state.theme.unfoldable);
    const sidebarShow = useSelector((state) => state.theme.sidebarShow);
    useEffect(() => {
        let adr = [];
        if (auth.loggedIn) {
            navigation.map((v, i) => {
                if (can(v.perms, auth.user)) {
                    if (v.items) {
                        let vv = { ...v, items: [] };
                        v.items.map((itm, idx) => {
                            if (can(itm.perms, auth.user)) {
                                vv.items.push(itm);
                            }
                            if (idx + 1 === v.items.length) {
                                adr.push(vv);
                            }
                            return 1;
                        });
                    } else {
                        adr.push(v);
                    }
                }else{
                    if(!v.perms.length){
                        adr.push(v)
                    }
                }
                if (i + 1 === navigation.length) {
                    setNavItems(adr);
                }
                return 1;
            });
        }
    }, [auth.loggedIn, auth.user]);
    const navig = useNavigate();

    return (
        <CSidebar
            position="fixed"
            unfoldable={unfoldable}
            visible={sidebarShow}
            onVisibleChange={(visible) => {
                dispatch(toggleSidebar(visible));
            }}
        >
            <CSidebarBrand
                className="d-none d-md-flex"
                onClick={() => navig("/home")}
                style={{ cursor: "pointer" }}
            >
                {/* <Fragment>
            <CImage className="sidebar-brand-full" src={siparpol} height={35} />
            <CImage className="sidebar-brand-narrow" src={kesbangpol} height={35} />
          </Fragment> */}
            </CSidebarBrand>
            <CDropdown variant="nav-item" className="mb-3">
                <CDropdownToggle placement="bottom-end" className="py-0" caret={false}>
                    <CAvatar src='https://picsum.photos/128/128' size="md" />
                </CDropdownToggle>
                <CDropdownMenu className="pt-0" placement="bottom-end">
                    <CDropdownHeader className="bg-light fw-semibold py-2">{auth.user ? auth.user.name : ''}</CDropdownHeader>
                    <CDropdownItem style={{ cursor: 'pointer' }}>
                    Logout
                    </CDropdownItem>
                </CDropdownMenu>
                </CDropdown>
            <CSidebarNav>
                <SimpleBar>
                    <AppSidebarNav items={navItems} />
                </SimpleBar>
            </CSidebarNav>
            <CSidebarToggler
                className="d-none d-lg-flex"
                onClick={() => dispatch(toggleUnfoldable(!unfoldable))}
            />
        </CSidebar>
    );
};

export default React.memo(AppSidebar);
